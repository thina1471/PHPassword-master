export class ButtonHandler {

	static #ENABLE_COLOR = "btn-outline-primary"
	static #DISABLE_COLOR = "btn-outline-secondary"

	static enableButtons(...buttons) {
		buttons.forEach(button => {
			button.classList.replace(this.#DISABLE_COLOR, this.#ENABLE_COLOR)
			button.disabled = false
		})
	}

	static disableButtons(...buttons) {
		buttons.forEach(button => {
			button.classList.replace(this.#ENABLE_COLOR, this.#DISABLE_COLOR)
			button.disabled = true
		})
	}

	static copyEvent(navigator, value) {
		navigator.clipboard.writeText(value)
	}
}