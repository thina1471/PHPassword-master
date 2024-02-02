export class FormHandler {

	#form
	#length
	#digits
	#specials

	constructor(form) {
		this.#form = form
		this.#length = form.elements["min-length"]
		this.#digits = form.elements["min-numbers"]
		this.#specials = form.elements["min-specials"]
	}

	submit() {
		if (this.#validateInputs()) {
			console.log("validated")
			this.#form.submit()
		}
	}

	#validateInputs() {
		return [
			this.#length.reportValidity(),
			this.#digits.reportValidity(),
			this.#specials.reportValidity(),
		].every(validation => validation == true)
	}
}