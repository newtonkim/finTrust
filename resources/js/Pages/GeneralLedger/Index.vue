<!-- resources/js/Pages/GeneralLedger/Index.vue -->
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    transactions: Object, // The paginated data from the controller
});

// A computed property to format the total debit and credit for each transaction
const formattedTransactions = computed(() => {
    return props.transactions.data.map(transaction => {
        let totalDebit = 0;
        let totalCredit = 0;
        transaction.entries.forEach(entry => {
            totalDebit += parseFloat(entry.debit);
            totalCredit += parseFloat(entry.credit);
        });
        return {
            ...transaction,
            totalDebit: totalDebit.toFixed(2),
            totalCredit: totalCredit.toFixed(2),
        };
    });
});
</script>

<template>
    <Head title="General Ledger" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">General Ledger</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium mb-4">All Transactions</h3>
                    
                    <div v-if="transactions.data.length === 0" class="text-gray-500 text-center py-8">
                        No transactions found.
                    </div>

                    <div v-else>
                        <div v-for="transaction in formattedTransactions" :key="transaction.id" class="border p-4 mb-4 rounded-lg shadow-sm">
                            <div class="flex justify-between items-center mb-2">
                                <div class="font-bold text-gray-800">
                                    {{ transaction.description }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    Date: {{ transaction.transaction_date }}
                                </div>
                            </div>
                            <div class="grid grid-cols-4 gap-2 text-sm text-gray-600 font-medium border-b pb-1 mb-2">
                                <div class="col-span-2">Account</div>
                                <div class="text-right">Debit</div>
                                <div class="text-right">Credit</div>
                            </div>
                            <div v-for="entry in transaction.entries" :key="entry.id" class="grid grid-cols-4 gap-2 text-sm">
                                <div class="col-span-2 text-gray-700">
                                    {{ entry.chart_of_account.account_name }} ({{ entry.chart_of_account.account_code }})
                                </div>
                                <div class="text-right text-gray-900">{{ parseFloat(entry.debit) > 0 ? entry.debit : '' }}</div>
                                <div class="text-right text-gray-900">{{ parseFloat(entry.credit) > 0 ? entry.credit : '' }}</div>
                            </div>
                            <div class="flex justify-between items-center font-bold text-gray-800 border-t mt-2 pt-2">
                                <div>Totals</div>
                                <div>{{ transaction.totalDebit }}</div>
                                <div>{{ transaction.totalCredit }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination Links -->
                    <div v-if="transactions.links.length > 3" class="flex justify-center mt-4 space-x-2">
                        <template v-for="(link, key) in transactions.links">
                            <div v-if="link.url === null" :key="key" class="px-4 py-2 text-sm text-gray-400 bg-gray-200 rounded-lg">
                                <span v-html="link.label"></span>
                            </div>
                            <Link v-else :key="`link-${key}`"
                                :class="{'bg-indigo-600 text-white': link.active, 'bg-gray-200': !link.active}"
                                :href="link.url"
                                class="px-4 py-2 text-sm rounded-lg hover:bg-indigo-500 hover:text-white"
                                v-html="link.label"
                            />
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>