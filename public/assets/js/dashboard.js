document.addEventListener('DOMContentLoaded', function () {
    M.Modal.init(document.querySelectorAll('.modal'), { dismissible: false });
    M.Sidenav.init(document.querySelectorAll('.sidenav'), { edge: "right" });
    // M.CharacterCounter.init(document.querySelectorAll('.character-counter'));
});

// document.addEventListener('DOMContentLoaded', function () {
//     /**
//      * Create
//      */
//     const createForm = document.querySelector('form.product-create');
//     createForm.addEventListener('submit', e => {
//         e.preventDefault();
//         const data = formDataToJSON(new FormData(createForm));

//         apiUse('post', '/products', data);
//     });

//     /**
//      * Update
//      */
//     const editForms = document.querySelectorAll('form.product-edit');
//     editForms.forEach(form => {
//         form.addEventListener('submit', e => {
//             e.preventDefault();
//             const id = form.getAttribute('data-id');
//             const data = formDataToJSON(new FormData(form));

//             apiUse('put', `/products/${id}`, data);
//         });
//     });

//     /**
//      * Delete
//      */
//     const deleteForms = document.querySelectorAll('form.product-delete');
//     deleteForms.forEach(form =>
//         form.addEventListener('submit', e => {
//             e.preventDefault();
//             const id = form.getAttribute('data-id');

//             apiUse('delete', `/products/${id}`, {});
//         })
//     );
// });
