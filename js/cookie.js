function sidExists() {
	if(Cookies.get('sed') === undefined)
		return false
	return true
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
