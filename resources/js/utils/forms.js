function collectControls(form) {
    const controls = [];
    const elements = form.querySelectorAll("TEXTAREA, INPUT, SELECT");

    elements.forEach((element) => {
        if (element.type === "file") {
            controls.push(element);
        } else {
            controls.push(element);
        }
    });

    return controls;
}

function getElementValue(element, options) {
    const tag = element.tagName;
    let value = "";

    if (tag === "SELECT") {
        value = element.value;
    } else if (tag === "INPUT" && element.type === "checkbox") {
        value = element.checked;
    } else if (tag === "INPUT" && element.type === "file") {
        value = element.files;
    } else {
        value = options.sanitize === false ? element.value : sanitize(element.value, options.skipsanitize);
    }

    return value;
}

function sanitize(value, skipsanitize) {
    // Implement your sanitization logic here
    return value;
}

export function toFormData(form, options = {}) {
    const controls = collectControls(form);
    const data = {};

    controls.forEach((control) => {
        const key = control.name || control.id;
        if (key) {
            const value = getElementValue(control, options);
            if (options.json) {
                if (!options.trim || value !== "") {
                    data[key] = value;
                }
            } else {
                data[key] = value;
            }
        }
    });

    if (options.json) {
        return data;
    } else {
        const formData = new FormData();
        for (const key in data) {
            if (Object.prototype.hasOwnProperty.call(data, key)) {
                const value = data[key];
                if (value instanceof FileList) {
                    Array.from(value).forEach((file) => {
                        formData.append(key, file, file.name);
                    });
                } else {
                    formData.append(key, value);
                }
            }
        }
        return formData;
    }
}
