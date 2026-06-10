export function printError(message) {
	console.log(`[ERROR | ${new Date().toLocaleString()}] ${message}`);
}

export function parseKey(reqUrl) {
	const params = new URLSearchParams(reqUrl.split('?')[1] || '');
	return params.get('key');
}
