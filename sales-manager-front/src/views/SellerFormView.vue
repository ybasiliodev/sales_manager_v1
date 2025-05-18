<template>
    <div class="max-w-md mx-auto mt-10 p-6 bg-white shadow rounded">
        <h2 class="text-xl font-bold mb-4">Register Seller</h2>
        <form @submit.prevent="saveSeller">
            <input v-model="name" type="text" placeholder="Name" class="mb-4 w-full p-2 border rounded" />
            <input v-model="email" type="email" placeholder="Email" class="mb-4 w-full p-2 border rounded" />
            <button class="bg-green-500 text-white px-4 py-2 rounded w-full">Save</button>
        </form>
    </div>
</template>

<script setup>
import { ref } from 'vue';
const name = ref('');
const email = ref('');

const saveSeller = () => {
    alert(`Seller ${name.value} with email ${email.value} saved!`);
    name.value = '';
    email.value = '';
};
</script>