function sidExists() {
	return Cookies.get('sed') !== undefined;

}

function setSID(sid) {
	Cookies.set("sid", sid)
}

function getSID() {
	return Cookies.get("sid")
}

function removeSID() {
	Cookies.remove("sid")
}
