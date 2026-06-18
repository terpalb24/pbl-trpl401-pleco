import config from '../config.json' with { type: 'json' };
import { printError, parseKey } from './util.js';
const STATUS_CODES = config.status_codes;
const PAYLOAD_PREFIXES = config.payload_prefixes;



export default async function(ws, req, db) {
	if (!ws.protocol) return ws.close(1008, 'Missing protocol');

	if (req.url !== '/') return ws.close(1008, 'Invalid request path');

	const key = ws.protocol;
	if (!key) return ws.close(1007, 'Invalid key');

	const robot = await fetchRobotData(db, key);
	if (!robot) return ws.close(1007, 'Invalid key');

	const robotId = robot.robot_id;

	console.log(`Robot ${robotId} connected.`);
	ws.send(STATUS_CODES.OK);

	// Memproses semua pesan yang diterima dari robot.
	ws.on('message', (msg) => receiveMessage(ws, db, robotId, msg));

	ws.on('error', errorEvent);

	ws.on('close', () => {
		console.log(`Robot ${robotId} disconnected`);
	});
}

async function fetchRobotData(db, key) {
	let conn;

	try {
		conn = await db.getConn();
		const data = await db.robot.select(conn, key);
		return data;
	} catch(err) {
		printError(err.message);
	} finally {
		if (conn) conn.release();
	}
}

async function receiveMessage(ws, db, robotId, msg) {
	const strMsg = msg.toString();
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
		return processGPSData(ws, db, robotId, data);
	} else if (prefix === 'ADDTRASH') {
		return processTrashData(ws, db, robotId, data);
	} else {
		return ws.send(STATUS_CODES.INVALID_BODY);
	}
}

async function processTrashData(ws, db, robotId, data) {
	const splitted = data.trim().split(',');
	if (!splitted.length || splitted.length !== 2) return ws.send(STATUS_CODES.INVALID_BODY);

	const trashType = splitted[0],
	amount = parseInt(splitted[1]);

	if (trashType.length > 32) return ws.send(STATUS_CODES.INVALID_BODY);
	if (isNaN(amount) || amount < 1) return ws.send(STATUS_CODES.INVALID_BODY);

	const insertSuccess = await insertTrashData(db, robotId, trashType, amount);
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

async function processGPSData(ws, db, robotId, data) {
	const insertSuccess = await insertGPSData(db, robotId, data);
	if (insertSuccess) {
		return ws.send(STATUS_CODES.OK);
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

function errorEvent(err) {
	printError(err.message);
}
