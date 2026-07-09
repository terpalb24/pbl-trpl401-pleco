import 'dotenv/config';

import * as db from './handlers/database.js';
import { checkConnection, connDisconnected } from './handlers/util.js';
import { PushRouteMessage } from './routes/push.js';

import { serve, upgradeWebSocket } from '@hono/node-server';
import { WebSocketServer } from 'ws';
import { Hono } from 'hono';



db.init();

const app = new Hono();

app.get(
	'/push',
	upgradeWebSocket(() => ({
		onOpen(_, ws) {
			checkConnection(ws, db, false);
		},
		onMessage(event, ws) {
			PushRouteMessage(event, ws, db);
		},
		onClose(_, ws) {
			connDisconnected(ws);
		}
	}))
);

app.get(
	'/pull',
	upgradeWebSocket(() => ({
		onOpen(_, ws) {
			checkConnection(ws, db, true);
		},
		onClose(_, ws) {
			connDisconnected(ws, true);
		}
	}))
);



const wss = new WebSocketServer({ noServer: true });
serve({
	fetch: app.fetch,
	port: process.env.PORT,
	websocket: { server: wss },
});
