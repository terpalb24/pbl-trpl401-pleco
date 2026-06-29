import config from '../config.json' with { type: 'json' };
import { printError, parseKey, fetchRobotData, pullConnections } from '../handlers/util.js';
const STATUS_CODES = config.status_codes;
const PAYLOAD_PREFIXES = config.payload_prefixes;



export const BroadcastCoords = async function(db) {
	while (true) {
		if (!pullConnections.length) {
			await new Promise(r => setTimeout(r, 5000));
			continue;
		}

		let robot;

		for (const conn of pullConnections) {
			robot = await fetchRobotData(db, conn.protocol);

			if (!robot) return;
			conn.send(robot.location_coordinates);
		}

		await new Promise(r => setTimeout(r, 5000));
	}
}
