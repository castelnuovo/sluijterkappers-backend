document.addEventListener('DOMContentLoaded', function () {
    M.Modal.init(document.querySelectorAll('.modal'), { dismissible: false });
    M.Sidenav.init(document.querySelectorAll('.sidenav'), { edge: "right" });
    M.CharacterCounter.init(document.querySelectorAll('.character-counter'));
    M.FormSelect.init(document.querySelectorAll('select'));
});

document.addEventListener('DOMContentLoaded', function () {
    /**
     * File Uploader
     */
    FilePond.registerPlugin(FilePondPluginFileValidateSize);
    FilePond.registerPlugin(FilePondPluginFileValidateType);
    FilePond.registerPlugin(FilePondPluginImageCrop);
    FilePond.registerPlugin(FilePondPluginImagePreview);
    FilePond.registerPlugin(FilePondPluginImageTransform);
    FilePond.create(document.querySelector('input[type="file"]'));

    FilePond.setOptions({
        maxFileSize: '5MB',
        acceptedFileTypes: ['image/*'],
        // imageCropAspectRatio: '1:1',
        server: {
            url: 'https://assets.castelnuovo.xyz/upload',
            process: {
                headers: {
                    'Authorization': window._assets_key
                },
                timeout: 7000,
                onload: (response) => {
                    response = JSON.parse(response);
                    document.querySelector('input[name="image"]').value = `https://assets.castelnuovo.xyz/${response.filename}`;
                },
            },
            revert: null,
            restore: null,
            fetch: null
        }
    });

    /**
     * Create
     */
    const createForm = document.querySelector('form.product-create');
    createForm.addEventListener('submit', e => {
        e.preventDefault();
        const data = formDataToJSON(new FormData(createForm));

        apiUse('post', '/products', data);
    });

    /**
     * Update
     */
    const editForms = document.querySelectorAll('form.product-edit');
    editForms.forEach(form => {
        form.addEventListener('submit', e => {
            e.preventDefault();
            const id = form.getAttribute('data-id');
            const data = formDataToJSON(new FormData(form));

            apiUse('put', `/products/${id}`, data);
        });
    });

    /**
     * Delete
     */
    const deleteForms = document.querySelectorAll('form.product-delete');
    deleteForms.forEach(form =>
        form.addEventListener('submit', e => {
            e.preventDefault();
            const id = form.getAttribute('data-id');

            apiUse('delete', `/products/${id}`, {});
        })
    );
});
