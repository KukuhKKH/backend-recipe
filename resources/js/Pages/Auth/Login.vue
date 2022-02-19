<template>
    <div class="login">
        <div class="login-content">
            <form @submit.prevent="submit">
                <h1 class="text-center">Sign In</h1>
                <div class="text-white text-opacity-50 text-center mb-4">
                    For your protection, please verify your identity.
                </div>
                <div class="mb-3">
                    <label class="form-label">Username<span class="text-danger">*</span></label>
                    <text-input v-model="form.username" :error="form.errors.username" class="form-group" label="Username"/>
                </div>
                <div class="mb-3">
                    <div class="d-flex">
                        <label class="form-label">Password <span class="text-danger">*</span></label>
                        <a href="#" class="ms-auto text-white text-decoration-none text-opacity-50">Forgot password?</a>
                    </div>
                    <text-input v-model="form.password" :error="form.errors.password" class="form-group" label="Username" type="password"/>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="customCheck1" />
                        <label class="form-check-label" for="customCheck1">Remember me</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-theme btn-lg d-block w-100 fw-500 mb-3">Sign In</button>
            </form>
        </div>
    </div>
</template>

<script setup>
import TextInput from '../../Components/Shared/TextInput.vue'
import { useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    username: '',
    password: '',
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
}
</script>
