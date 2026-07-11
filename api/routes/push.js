import config from '../config.json' with { type: 'json' };
import { printError, parseKey, fetchRobotData, pullConnections, setBatteryPercent } from '../handlers/util.js';
const STATUS_CODES = config.status_codes;
const PAYLOAD_PREFIXES = config.payload_prefixes;



export const PushRouteMessage = async function(event, ws, db) {
	const strMsg = event.data.toString().trim();
	if (!strMsg.length) return ws.close(1003, 'Missing content');

	// Payload yang valid: PREFIX|data,dan,seterusnya
	const splittedPayload = strMsg.trim().split('|');
	if (splittedPayload.length !== 2) return ws.send(STATUS_CODES.INVALID_BODY);

	// GPSLOCAT -- Prefix untuk menerima lokasi GPS robot
	// ADDTRASH -- Prefix untuk menerima data sampah
	// _BATTERY -- Prefix untuk menerima data persentase baterai yang tersisa
	const prefix = splittedPayload[0];
	if (prefix.length !== 8) return ws.send(STATUS_CODES.INVALID_BODY);

	const data = splittedPayload[1].trim();

	// data.length > 5 | skip jika data terlalu pendek
	if (prefix === 'GPSLOCAT' && data.length > 4) {
		return processGPSData(ws, db, data);
	} else if (prefix === 'ADDTRASH' && data.length > 4) {
		return processTrashData(ws, db, data);
	} else if (prefix === '_BATTERY') {
		return processBatteryData(ws, data);
	} else {
		return ws.send(STATUS_CODES.INVALID_BODY);
	}
}



async function processTrashData(ws, db, data) {
	const splitted = data.trim().split(',');
	if (!splitted.length || splitted.length !== 2) return ws.send(STATUS_CODES.INVALID_BODY);

	const trashType = splitted[0],
	amount = parseInt(splitted[1]);

	if (trashType.length > 32) return ws.send(STATUS_CODES.INVALID_BODY);
	if (isNaN(amount) || amount < 1) return ws.send(STATUS_CODES.INVALID_BODY);

	//const insertSuccess = await insertTrashData(db, ws.robotId, trashType, amount);
	const insertSuccess = await insertData(db, 'trash', ws.robotId, trashType, amount);
	if (insertSuccess) {
		return ws.send(STATUS_CODES.OK);
	} else {
		return ws.send(STATUS_CODES.INVALID_TRASH_TYPE);
	}
}

async function processGPSData(ws, db, data) {
	const splittedData = data.split(" ");
	if (splittedData.length !== 2) return ws.send(STATUS_CODES.INVALID_BODY);

	let [lat, lng] = [splittedData[0], splittedData[1]];
	if (isNaN(lat) || isNaN(lng)) return ws.send(STATUS_CODES.INVALID_BODY);

	//const insertSuccess = await insertGPSData(db, ws.robotId, data);
	const insertSuccess = await insertData(db, 'robots', ws.robotId, data);
	if (insertSuccess) {
		ws.send(STATUS_CODES.OK);
		broadcastData(`GPS:${data}`);
		return;
	} else {
		return ws.send(STATUS_CODES.INVALID_TRASH_TYPE);
	}
}

async function insertData(db, table, robotId, ...data) {
	let conn;

	try {
		conn = await db.getConn();

		if (table === 'trash') {
			return await db.collectedTrash.updateAndSuccess(conn, robotId, data[0], data[1]);
		} else {
			return await db.robot.updateAndSuccess(conn, robotId, data[0]);
		}
	} catch(err) {
		printError(err.message);
		return false;
	} finally {
		if (conn) conn.release();
	}
}

function processBatteryData(ws, data) {
	const intData = Number(data);
	if (isNaN(intData)) return ws.send(STATUS_CODES.INVALID_BODY);

	if (intData < 0 || intData > 100) return ws.send(STATUS_CODES.INVALID_BODY);

	setBatteryPercent(intData);
	broadcastData(`BAT:${intData}`);
}

function broadcastData(data) {
	if (!pullConnections.length) return;
	for (const conn of pullConnections) conn.send(data);
}
