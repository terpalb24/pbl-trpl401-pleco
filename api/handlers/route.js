import config from '../config.json' with { type: 'json' };
import { printError } from './util.js';
const STATUS_CODES = {
	OK: 200,
	INVALID_BODY: 422,
	INVALID_TRASH_TYPE: 406
}



export default async function(ws, req, db) {
	const key = parseKey(req.url);
	if (!key) return ws.close(1007, 'Robot key is not valid');

	const robot = await fetchRobotData(db, key);
	if (!robot) return ws.close(1007, 'Robot key is not valid');

	const robotId = robot.robot_id;

	console.log(`Robot ${robotId} connected.`);
	ws.send(STATUS_CODES.OK);

	ws.on('message', (msg) => receiveMessage(ws, db, robotId, msg));

	ws.on('error', errorEvent);

	ws.on('close', () => {
		console.log(`Robot ${robotId} disconnected`);
	});
}



function parseKey(reqUrl) {
	const params = new URLSearchParams(reqUrl.split('?')[1] || '');
	return params.get('key');
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

	const splitted = strMsg.trim().split(',');
	if (!splitted.length || splitted.length !== 2) return ws.send(STATUS_CODES.INVALID_BODY);

	const trashType = splitted[0],
	amount = parseInt(splitted[1]);

	if (trashType.length > 32) return ws.send(STATUS_CODES.INVALID_BODY);
	if (isNaN(amount) || amount < 1) return ws.send(STATUS_CODES.INVALID_BODY);

	const insertSuccess = await insertTrashData(db, robotId, trashType, amount);
	if (insertSuccess) {
		ws.send(STATUS_CODES.OK);
	} else {
		ws.send(STATUS_CODES.INVALID_TRASH_TYPE);
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

function errorEvent(err) {
	printError(err.message);
}
