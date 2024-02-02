class Resources {

	#data
	#defined

	constructor() {
		this.defined = false
	}

	async setData(location) {
		if (this.#defined) return

		this.#defined = true

		this.#data = await fetch(`${location}/Constants.json`)
			.then(response => response.json())
			.then(json => json)
	}

	minLength() {return this.#data["length"]}
	minDigits() {return this.#data["digits"] }
	minCapitals() {return this.#data["capitals"]}
	minLowers() {return this.#data["lowers"] }
	minSpecials() {return this.#data["specials"]}
}

const resourcesInstance = new Resources()

Object.freeze(resourcesInstance)

export default resourcesInstance
