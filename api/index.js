import 'dotenv/config';
import { WebSocketServer } from 'ws';

import * as db from './handlers/database.js';
import config from './config.json' with { type: 'json' };
import route from './handlers/route.js';



db.init();

const ws = new WebSocketServer(config.websocket);
ws.on('connection', (ws, req) => route(ws, req, db));
