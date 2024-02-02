import { Alert } from "./Alert.js";
import { Validator } from "./Validator.js";
import { ButtonHandler } from "./ButtonHandler.js";
import { FormHandler } from "./FormHandler.js";
import resourcesInstance from "./Resources.js";

await resourcesInstance.setData(window.location.origin)

const generate = document.getElementsByName("password-generate")[0],
	copy = document.getElementsByName("password-copy")[0],
	validate = document.getElementsByName("password-validate")[0],
	password = document.getElementsByName("password-placeholder")[0],
	form = new FormHandler(document.getElementsByName("password-parameters")[0]),
	alerter = new Alert(document.getElementsByName("alert-placeholder")[0])

password.addEventListener("input", () => {
	password.dataset.value = password.value
	alerter.generateAlert("requirements")
	if (password.dataset.value.length >= 15) ButtonHandler.enableButtons(copy, validate)
	else ButtonHandler.disableButtons(copy, validate)
})

generate.addEventListener("click", () => form.submit())

copy.addEventListener("click", () => {
	ButtonHandler.copyEvent(navigator, password.dataset.value)
	alerter.generateAlert("copy")
})

validate.addEventListener("click", () => alerter.generateAlert(
	Validator.validatePassword(password.dataset.value) ? "secure" : "insecure"
))
