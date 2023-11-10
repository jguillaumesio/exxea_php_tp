let modal;
window.addEventListener('DOMContentLoaded',() => {
    modal = document.querySelector("#modal");
});
const toggleModal = (title = '', content = '', forceClose = true) => {
    const contentDom = modal.querySelector('.body');
    const titleDom = modal.querySelector('.title');
    if(modal && contentDom && titleDom){
        modal.classList.add('close');
        contentDom.innerHTML = content;
        titleDom.innerHTML = title;
        if(forceClose){
            modal.classList.add('close');
        } else {
            modal.classList.remove('close');
        }
    }
}

const setFieldError = (fieldName, message) => {
    let fieldWrapper = document.querySelector(`div > *[name='${fieldName}']`);
    console.log(fieldWrapper);
    if (fieldWrapper) {
        fieldWrapper = fieldWrapper.parentElement;
        fieldWrapper.classList.add("error");
        const spanElement = fieldWrapper.querySelector(".label_error");
        if (spanElement) {
            spanElement.innerHTML = message;
        }
    }
}

const isFormValid = (data) => {
    const titleRegex = /^[\w\s.,-]*\S[\w\s.,-]*$/; // Alphanumeric, spaces, commas, dots, and hyphens, with at least one non-whitespace character
    const ISBNRegex = /^[0-9]{10,13}$/;
    const pageNbrRegex = /^[0-9]+$/;
    const priceRegex = /^[0-9]*([.,][0-9]{1,2})?$/;
    const languageRegex = /^[A-Za-z]+$/; // Only alpha characters
    const nameRegex = /^[A-Za-zÀ-ÖØ-öø-ÿ ]{2,}$/; // Accepts only letters and spaces
    const yearRegex = /^[0-9]{4}$/;

    let result = true;

    const validateField = (fieldName, value, regex, errorMessage) => {
        if (value === undefined || value === null || value.trim() === "") {
            setFieldError(fieldName, `Tu dois renseigner ${fieldName} !`);
            result = false;
        } else if (!regex.test(value)) {
            setFieldError(fieldName, errorMessage);
            result = false;
        }
    };

    validateField("title", data.title, titleRegex, "Le titre du livre doit contenir au moins un caractère et ne peut contenir que des lettres, des espaces, des virgules, des points et des tirets.");
    validateField("ISBN", data.ISBN, ISBNRegex, "L'ISBN doit être un nombre de 10 à 13 chiffres");
    validateField("theme", data.theme, titleRegex, "Le thème du livre doit contenir au moins un caractère et ne peut contenir que des lettres, des espaces, des virgules, des points et des tirets.");
    validateField("page_nbr", data.page_nbr, pageNbrRegex, "Le nombre de pages doit être un nombre entier");
    validateField("format", data.format, titleRegex, "Le format du livre doit contenir au moins un caractère et ne peut contenir que des lettres, des espaces, des virgules, des points et des tirets.");
    validateField("author_firstname", data.author_firstname, nameRegex, "Le prénom de l'auteur doit contenir au moins deux caractères alphabétiques");
    validateField("author_lastname", data.author_lastname, nameRegex, "Le nom de l'auteur doit contenir au moins deux caractères alphabétiques");
    validateField("editor", data.editor, nameRegex, "Le nom de l'éditeur doit contenir au moins deux caractères alphabétiques");
    validateField("edition_year", data.edition_year, yearRegex, "L'année d'édition doit être un nombre de quatre chiffres");
    validateField("price", data.price, priceRegex, "Le prix doit être un entier ou un nombre décimal");
    validateField("language", data.language, languageRegex, "La langue doit contenir au moins un caractère et ne peut contenir que des lettres.");

    return result;
};

const resetFieldsError = () => {
    document.querySelectorAll(`label.error > .label_error`).forEach(e => {
        e.parentElement.classList.remove("error");
        const spanElement = e.parentElement.querySelector(".label_error");
        if (spanElement) {
            spanElement.innerHTML = "";
        }
    })
}

const validateForm = async (e) => {
    e.target.setAttribute("disabled", true);
    resetFieldsError();
    const fields = {
        "title": document.querySelector("#title")?.value,
        "ISBN": document.querySelector("#ISBN")?.value,
        "theme": document.querySelector("#theme")?.value,
        "page_nbr": document.querySelector("#page_nbr")?.value,
        "format": document.querySelector("#format")?.value,
        "author_firstname": document.querySelector("#author_firstname")?.value,
        "author_lastname": document.querySelector("#author_lastname")?.value,
        "editor": document.querySelector("#editor")?.value,
        "edition_year": document.querySelector("#edition_year")?.value,
        "price": document.querySelector("#price")?.value,
        "language": document.querySelector("#language")?.value,
    }
    const result = isFormValid(fields);
    if (!result) {
        e.preventDefault();
    }
}