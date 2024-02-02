import resourcesInstance from "./Resources.js"

export class Validator {
	static #PASSWORD_REGEX_DIGITS = /\d/g
	static #PASSWORD_REGEX_LOWERS = /[a-z]/g
	static #PASSWORD_REGEX_CAPITALS = /[A-Z]/g


	static validatePassword(password) {
		return [
			password.length >= resourcesInstance.minLength(),
			this.#checkPasswordParameter(password, resourcesInstance.minDigits(), this.#PASSWORD_REGEX_DIGITS),
			this.#checkPasswordParameter(password, resourcesInstance.minLowers(), this.#PASSWORD_REGEX_LOWERS),
			this.#checkPasswordParameter(password, resourcesInstance.minCapitals(), this.#PASSWORD_REGEX_CAPITALS)
		].every(validation => validation === true)
	}

	static #checkPasswordParameter(text, occurrences, pattern) {
		return text.length > 0 ? (text.match(pattern) ?? []).length >= occurrences : false
	}
}