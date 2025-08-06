<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';  
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const  props = defineProps({
    accounts: Object,
    allAccounts: Object, // All accounts for the parent dropdown
});

const form = useForm({
    'gl_code' : '',
    'name' : '', 
    'account_type': 'Asset',
    'parent_account_id': null,
    'description': '',
});

const showForm = ref(false);
const editingAccount = ref(null);

const submitForm = () => {
    if (editingAccount.value) {
        form.put(route('chart-of-accounts.update', editingAccount.value.id), {
            onSuccess: () => {
                showForm.value = false;
                editingAccount.value = null;
                form.reset();
            },
        });
    } else {
        form.post(route('chart-of-accounts.store'), {
            onSuccess: () => {
                showForm.value = false;
                form.reset();
            },
        });
    }
};

const editAccount = (account) => {
    editingAccount.value = account;
    form.gl_code = account.gl_code;
    form.name = account.name; 
    form.account_type = account.account_type;
    form.parent_account_id = account.parent_account_id;
    form.description = account.description;
    showForm.value = true;
};

const deleteAccount = (id) => {
    if (confirm('Are you sure you want to delete this account?')) {
       useForm({}).delete(route('chart-of-accounts.destroy', id));
    }
};

const cancelForm = () => {
    showForm.value = false;
    editingAccount.value = null;
    form.reset();
};
</script>

<template>
    <Head title="Chart of Accounts"/>
   
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Chart of Accounts</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <button @click="showForm = true" class="px-4 py-2 bg-indigo-600 text-white rounded-md mb-4">
                        Add New Account
                    </button>

                    <div v-if="showForm" class="mb-6 p-4 border rounded-md">
                        <h3 class="text-lg font-medium mb-4">{{ editingAccount ? 'Edit Account' : 'Create New Account' }}</h3>
                        <form @submit.prevent="submitForm">
                            <div class="mb-4">
                                <label for="gl_code" class="block text-sm font-medium text-gray-700">GL Code</label>
                                <input type="text" id="gl_code" v-model="form.gl_code" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                                <div v-if="form.errors.gl_code" class="text-red-500 text-sm">{{ form.errors.gl_code }}</div>
                            </div>
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700">Account Name</label>
                                <input type="text" id="name" v-model="form.name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                                <div v-if="form.errors.name" class="text-red-500 text-sm">{{ form.errors.name }}</div>
                            </div>
                            <div class="mb-4">
                                <label for="account_type" class="block text-sm font-medium text-gray-700">Account Type</label>
                                <select id="account_type" v-model="form.account_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    <option value="Asset">Asset</option>
                                    <option value="Liability">Liability</option>
                                    <option value="Equity">Equity</option>
                                    <option value="Revenue">Revenue</option>
                                    <option value="Expense">Expense</option>
                                </select>
                                <div v-if="form.errors.account_type" class="text-red-500 text-sm">{{ form.errors.account_type }}</div>
                            </div>
                            <div class="mb-4">
                                <label for="parent_account_id" class="block text-sm font-medium text-gray-700">Parent Account (Optional)</label>
                                <select id="parent_account_id" v-model="form.parent_account_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    <option :value="null">-- None --</option>
                                    <!-- Use allAccounts for the dropdown -->
                                    <option v-for="account in allAccounts" :key="account.id" :value="account.id">
                                        {{ account.name }} ({{ account.gl_code }})
                                    </option>
                                </select>
                                <div v-if="form.errors.parent_account_id" class="text-red-500 text-sm">{{ form.errors.parent_account_id }}</div>
                            </div>
                             <div class="mb-4">
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea id="description" v-model="form.description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                                <div v-if="form.errors.description" class="text-red-500 text-sm">{{ form.errors.description }}</div>
                            </div>
                            <div class="flex space-x-2">
                                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md">{{ editingAccount ? 'Update' : 'Create' }}</button>
                                <button type="button" @click="cancelForm" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md">Cancel</button>
                            </div>
                        </form>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Parent</th>
                                <th scope="col" class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Check if accounts.data is not empty before rendering rows -->
                            <template v-if="accounts.data && accounts.data.length > 0">
                                <tr v-for="account in accounts.data" :key="account.id">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ account.gl_code }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ account.name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ account.account_type }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ account.parent_account?.name || '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button @click="editAccount(account)" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</button>
                                        <button @click="deleteAccount(account.id)" class="text-red-600 hover:text-red-900">Delete</button>
                                    </td>
                                </tr>
                            </template>
                            <template v-else>
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No accounts found.</td>
                                </tr>
                            </template>
                        </tbody>
                    </table>

                    <!-- Only show pagination links if there are multiple pages -->
                    <div v-if="accounts.links && accounts.links.length > 3" class="mt-4 flex justify-center space-x-1">
                        <template v-for="link in accounts.links" :key="`link-${link.label}-${link.url || 'disabled'}`">
                            <Link v-if="link.url" 
                                :href="link.url"
                                :class="{ 
                                    'bg-blue-500 text-white font-bold': link.active,
                                    'bg-white text-gray-700 hover:bg-gray-100': !link.active 
                                }"
                                class="px-3 py-1 text-sm leading-5 font-medium rounded-md border focus:outline-none focus:ring focus:border-blue-300"
                                v-html="link.label"
                            />
                            <span v-else
                                class="px-3 py-1 text-sm leading-5 font-medium rounded-md text-gray-400 bg-gray-100 border"
                                v-html="link.label"
                            />
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>