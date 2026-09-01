const button = document.getElementById('MovementButton');
const form = document.getElementById('MovementForm');

if (button && form) {
    button.addEventListener('click', () => {
        form.classList.toggle('hidden');
        form.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
}

// ---- Edição de produto ----
const editModal = document.getElementById('editProductModal');
const editForm = document.getElementById('editProductForm');
const closeEditModal = document.getElementById('closeEditModal');
const cancelEdit = document.getElementById('cancelEdit');
const editButtons = document.querySelectorAll('.edit-product');

if (editModal && editForm && editButtons.length) {

    editButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.id;

            // preenche os campos com os dados do produto clicado
            document.getElementById('editName').value = btn.dataset.name;
            document.getElementById('editDescription').value = btn.dataset.description;
            document.getElementById('editPrice').value = btn.dataset.price;

            // define para onde o form deve enviar (precisa da rota com o id)
            editForm.dataset.productId = id;

            editModal.classList.remove('hidden');
            editModal.classList.add('flex');
        });
    });

    const hideModal = () => {
        editModal.classList.add('hidden');
        editModal.classList.remove('flex');
    };

    if (closeEditModal) closeEditModal.addEventListener('click', hideModal);
    if (cancelEdit) cancelEdit.addEventListener('click', hideModal);

    editForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const id = editForm.dataset.productId;
        const formData = new FormData(editForm);
        formData.append('_method', 'PUT'); // necessário para upload + PUT no Laravel

        const response = await fetch(`/products/${id}`, {
            method: 'POST', // POST + _method=PUT (spoofing), obrigatório quando há arquivo
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json',
            },
            body: formData,
        });

        if (response.ok) {
            location.reload(); // ou atualize o card na tela sem reload
        } else {
            const err = await response.json();
            console.error(err);
        }
    });
}

// -- Edição de usuário --
const editUserModal = document.getElementById('editUserModal');
const editUserForm = document.getElementById('editUserForm');
const closeEditUserModal = document.getElementById('closeEditUserModal');
const cancelEditUser = document.getElementById('cancelEditUser');
const editUserButtons = document.querySelectorAll('.edit-user');

if (editUserModal && editUserForm && editUserButtons.length) {
    editUserButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.id;

            if (!id) return;

            const nameInput = document.getElementById('editName');
            const emailInput = document.getElementById('editEmail');

            if (nameInput) nameInput.value = btn.dataset.name ?? '';
            if (emailInput) emailInput.value = btn.dataset.email ?? '';

            editUserForm.dataset.userId = id;
            editUserModal.classList.remove('hidden');
            editUserModal.classList.add('flex');
        });
    });

    const hideUserModal = () => {
        editUserModal.classList.add('hidden');
        editUserModal.classList.remove('flex');
    };

    if (closeEditUserModal) closeEditUserModal.addEventListener('click', hideUserModal);
    if (cancelEditUser) cancelEditUser.addEventListener('click', hideUserModal);

    editUserForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const id = editUserForm.dataset.userId;
        const formData = new FormData(editUserForm);
        formData.append('_method', 'PUT');

        const csrfToken = document.querySelector('input[name="_token"]');

        const response = await fetch(`/users/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken ? csrfToken.value : '',
                'Accept': 'application/json',
            },
            body: formData,
        });

        if (response.ok) {
            location.reload();
        } else {
            const err = await response.json();
            console.error(err);
        }
    });
}