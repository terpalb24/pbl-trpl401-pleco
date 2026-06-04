export const select = async(conn, apiKey) => {
	return (
		await conn.query('SELECT robot_id FROM robots WHERE api_key = ?;', [apiKey])
	)[0];
}
