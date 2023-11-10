const getForm = (data) => {
    return `
<form method="post" action="${data?.form_action ?? ''}" onsubmit="return validateForm(event)">
    <div class="input_group">
        <div style="flex:2">
            <label for="title">Titre du livre:</label>
            <input type="text" name="title" id="title" value="${data?.book?.title ?? ''}" required>
            <span class="label_error"></span>
        </div>
        <div style="flex:1">
            <label for="language">Langage:</label>
            <input type="text" name="language" id="language" value="${data?.book?.language ?? ''}" required>
            <span class="label_error"></span>
        </div>
        <div style="flex:1">
            <label for="page_nbr">Nombre de pages:</label>
            <input type="number" name="page_nbr" id="page_nbr" value="${data?.book?.page_nbr ?? ''}" required>
            <span class="label_error"></span>
        </div>
        <div style="flex:1">
            <label for="price">Prix:</label>
            <input type="text" name="price" id="price" value="${data?.book?.price ?? ''}" required>
            <span class="label_error"></span>
        </div>
    </div>

    <div class="input_group">
        <div style="flex:1;">
            <label for="ISBN">ISBN:</label>
            <input type="text" name="ISBN" id="ISBN" value="${data?.book?.ISBN ?? ''}" required>
            <span class="label_error"></span>
        </div>

        <div style="flex:1;">
            <label for="theme">Thème:</label>
            <input type="text" name="theme" id="theme" value="${data?.book?.theme ?? ''}" required>
            <span class="label_error"></span>
        </div>

        <div style="flex:1;">
            <label for="format">Format:</label>
            <input type="text" name="format" id="format" value="${data?.book?.format ?? ''}" required>
            <span class="label_error"></span>
        </div>
    </div>

    <div class="input_group">
        <div style="flex:1;">
            <label for="author_firstname">Prénom de l'auteur:</label>
            <input type="text" name="author_firstname" id="author_firstname" value="${data?.book?.author_firstname ?? ''}" required>
            <span class="label_error"></span>
        </div>

        <div style="flex:1;">
            <label for="author_lastname">Nom de l'auteur:</label>
            <input type="text" name="author_lastname" id="author_lastname" value="${data?.book?.author_lastname ?? ''}" required>
            <span class="label_error"></span>
        </div>
    </div>

    <div class="input_group">
        <div style="flex:1;">
            <label for="editor">Editeur:</label>
            <input type="text" name="editor" id="editor" value="${data?.book?.editor ?? ''}" required>
            <span class="label_error"></span>
        </div>

        <div style="flex:1;">
            <label for="edition_year">Année d'édition:</label>
            <input type="number" name="edition_year" id="edition_year" value="${data?.book?.edition_year ?? ''}" required>
            <span class="label_error"></span>
        </div>
    </div>

    <div>
        <button type="submit" class="primary_button">${data?.form_button ?? ''}</button>
    </div>
</form>
`;
}