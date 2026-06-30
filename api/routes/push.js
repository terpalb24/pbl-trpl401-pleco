import config from '../config.json' with { type: 'json' };
import { printError, parseKey, fetchRobotData, pullConnections } from '../handlers/util.js';
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
	const prefix = splittedPayload[0];
	if (prefix.length !== 8) return ws.send(STATUS_CODES.INVALID_BODY);

	const data = splittedPayload[1].trim();

	// Data terlalu pendek
	if (data.length < 5) return ws.send(STATUS_CODES.INVALID_BODY);

	if (prefix === 'GPSLOCAT') {
		return processGPSData(ws, db, data);
	} else if (prefix === 'ADDTRASH') {
		return processTrashData(ws, db, data);
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

	const insertSuccess = await insertTrashData(db, ws.robotId, trashType, amount);
	if (insertSuccess) {
		return ws.send(STATUS_CODES.OK);
	} else {
		return ws.send(STATUS_CODES.INVALID_TRASH_TYPE);
	}
}

async function insertTrashData(db, robotId, trashType, amount) {
	let conn;

	try {
		conn = await db.getConn();
		return await db.trashCounter.updateAndSuccess(conn, robotId, trashType, amount);
	} catch(err) {
		printError(err.message);
		return false;
	} finally {
		if (conn) conn.release();
	}
}

async function processGPSData(ws, db, data) {
	const insertSuccess = await insertGPSData(db, ws.robotId, data);
	if (insertSuccess) {
		ws.send(STATUS_CODES.OK);
		await broadcastData(db, data);
		return;
	} else {
		return ws.send(STATUS_CODES.INVALID_TRASH_TYPE);
	}
}

async function insertGPSData(db, robotId, coords) {
	let conn;

	try {
		conn = await db.getConn();
		return await db.robot.updateAndSuccess(conn, robotId, coords);
	} catch(err) {
		printError(err.message);
		return false;
	} finally {
		if (conn) conn.release();
	}
}

async function broadcastData(db, data) {
	if (!pullConnections.length) return;

	for (const conn of pullConnections) {
		conn.send(data);
	}
}
