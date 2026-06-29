import config from '../config.json' with { type: 'json' };
const STATUS_CODES = config.status_codes;
export let pullConnections = [];



export function printError(message) {
	console.log(`[ERROR | ${new Date().toLocaleString()}] ${message}`);
}

export function parseKey(reqUrl) {
	const params = new URLSearchParams(reqUrl.split('?')[1] || '');
	return params.get('key');
}

export async function checkConnection(ws, db, broadcast) {
	const key = ws.protocol;
	if (!key) return ws.close(1008, 'Missing protocol');

	const robot = await fetchRobotData(db, key);
	if (!robot) return ws.close(1007, 'Invalid key');

	ws.robotId = robot.robot_id;
	ws.id = Date.now() + Math.random();
	console.log(`Client with robot ID ${ws.robotId} has been connected.`);

	if (broadcast) {
		pullConnections.push(ws);
	}

	ws.send(STATUS_CODES.OK);
}

export async function connDisconnected(ws, broadcast) {
	if (broadcast) {
		pullConnections = pullConnections.filter(conn => conn.id != ws.id);
	}

	if (ws.robotId) console.log(`Client with robot ID ${ws.robotId} has been disconnected`);
}



export async function fetchRobotData(db, key) {
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
