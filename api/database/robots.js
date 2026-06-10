import { printError } from '../handlers/util.js';

export const select = async(conn, apiKey) => {
	return (
		await conn.query('SELECT robot_id,location_coordinates FROM robots WHERE api_key = ?;', [apiKey])
	)[0];
}

export const updateAndSuccess = async(conn, robotId, coords) => {
	try {
		await conn.query(
			`UPDATE robots SET location_coordinates = ? WHERE robot_id = ?;`,
			[ coords, robotId ]
		);

		return true;
	} catch(err) {
		printError(err.message);
		return false;
	}
}
