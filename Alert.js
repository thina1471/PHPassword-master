export class Alert {

	#alerts
	#alertContent
	#alertPlaceholder
	#alertGenerated

	constructor(alertPlaceholder) {
		this.#alerts = {
			"secure": ["success", "Password is secure"],
			"insecure": ["danger", "Password is insecure"],
			"copy": ["info", "Password copied to clipboard"],
			"requirements": ["warning", [
				"<ul>",
				"<li>Require at least 15 total characters</li>",
				"<li>Require at least 5 numerical characters</li>",
				"<li>Require at least 3 capital letters</li>",
				"<li>Require at least 2 lower letters</li>",
				"<li>Special characters are optional</li>",
				"</ul>"
			].join("")]
		}
		this.#alertPlaceholder = alertPlaceholder
	}

	generateAlert(alertType) {
		this.#clearAlert()
		this.#setAlertContent(alertType)
		this.#setAlertElement()
		this.#alertPlaceholder.append(this.#alertGenerated)
	}

	#setAlertContent(alertType) {
		this.#alertContent = this.#alerts[alertType]
	}

	#setAlertElement() {
		const alertBody = this.#setAlertBody(),
			alertMessage = this.#setAlertMessage(),
			alertButton = this.#setAlertButton()

		alertBody.append(alertMessage, alertButton)

		this.#alertGenerated = alertBody
	}

	#setAlertBody() {
		const alertBody = document.createElement("div")

		alertBody.classList.add("alert", `alert-${this.#alertContent[0]}`, "alert-dismissible", "my-5")
		alertBody.setAttribute("role", "alert")

		return alertBody
	}

	#setAlertMessage() {
		const alertMessage = document.createElement("span")

		alertMessage.innerHTML = this.#alertContent[1]

		return alertMessage
	}

	#setAlertButton() {
		const alertButton = document.createElement("button")

		alertButton.classList.add("btn-close")
		alertButton.setAttribute("data-bs-dismiss", "alert")
		alertButton.type = "button"
		alertButton.ariaLabel = "Close"

		return alertButton
	}

	#clearAlert() {
		const lastChild = this.#alertPlaceholder.lastChild
		if (lastChild != null) this.#alertPlaceholder.removeChild(lastChild)
	}
}