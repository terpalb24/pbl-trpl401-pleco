import * as mariadb from 'mariadb';
import { readFileSync } from 'fs';

import * as robotHandler from '../database/robots.js';
import * as trashCounterHandler from '../database/trash_counter.js';

let pool;

export async function init() {
	const certsPath = process.env.CERT_FILES_DIR_FULL_PATH;

	pool = mariadb.createPool({
		user: process.env.DB_USER,
		password: process.env.DB_PASSWORD,
		host: process.env.DB_HOST,
		port: process.env.DB_PORT,
		database: process.env.DB_DATABASE,
		connectionLimit: process.env.DB_CONN_LIMIT ?? 10,
		connectTimeout: 5000,
		ssl: {
			cert: readFileSync(certsPath + 'client-cert.pem'),
			key: readFileSync(certsPath + 'client-key.pem'),
			ca: readFileSync(certsPath + 'ca-cert.pem'),
			rejectUnauthorized: true
		}
	});

	console.log('Database pool has been created');
}

export async function getConn() {
	return await pool.getConnection();
}

export const robot = robotHandler;
export const trashCounter = trashCounterHandler;



process.on('SIGTERM', closePool);
process.on('SIGINT', closePool);

async function closePool() {
	console.log('\nClosing down database pool...');

	try {
		await pool.end();
		console.log('Pool closed, goodbye');
		process.exit(0);
	} catch(err) {
		console.error(`Error while closing pool: ${err.message}`);
		process.exit(1);
	}
}
