import { printError } from '../handlers/util.js';

export const updateAndSuccess = async(conn, robotId, trashType, amount) => {
	try {
		const date = new Date().toLocaleDateString('en-CA');
		const counterExists = await checkCounter(conn, robotId, trashType);
		if (!counterExists) {
			await conn.query(
				`INSERT INTO collected_trash(robot_id, trash_id, total, collected_at) VALUES(?, ?, ?, ?);`,
				[ robotId, trashType, amount, date ]
			);
			return true;
		}

		await conn.query(
			`UPDATE collected_trash SET total = total + ?
			WHERE robot_id = ? AND trash_id = ? AND collected_at = ?;`,
			[ amount, robotId, trashType, date ]
		);

		return true;
	} catch (err) {
		printError(err.message);
		return false;
	}
}

async function checkCounter(conn, robotId, trashType, date) {
	return (
		await conn.query(
			'SELECT 1 FROM collected_trash WHERE robot_id = ? AND trash_id = ? AND collected_at = ?;',
			[ robotId, trashType, date ]
		)
	)[0];
}
