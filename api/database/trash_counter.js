import { printError } from '../handlers/util.js';

export const updateAndSuccess = async(conn, robotId, trashType, amount) => {
	try {
		const counterExists = await checkCounter(conn, robotId, trashType);
		if (!counterExists) {
			await conn.query(
				`INSERT INTO trash_counter(robot_id, trash_id, amount) VALUES(?, ?, ?);`,
				[ robotId, trashType, amount ]
			);
			return true;
		}

		await conn.query(
			`UPDATE trash_counter SET amount = amount + ? WHERE robot_id = ? AND trash_id = ?;`,
			[ amount, robotId, trashType ]
		);

		return true;
	} catch (err) {
		printError(err.message);
		return false;
	}
}

async function checkCounter(conn, robotId, trashType) {
	return (
		await conn.query(
			'SELECT 1 FROM trash_counter WHERE robot_id = ? AND trash_id = ?;',
			[ robotId, trashType ]
		)
	)[0];
}
