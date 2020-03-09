<template>
    <v-app class="grey lighten-4">
        <Navbar />
        <v-content class="mx-4">
            <transition name="component-fade" mode="out-in">
                <router-view></router-view>
            </transition>
        </v-content>
    </v-app>
</template>

<script>
import Navbar from './components/Navbar';

export default {
    name: 'App',
    components: {
        Navbar
    },
    data: () => ({
        //
    }),
};
</script>

<style lang="scss">
label {
    display: block;
    margin-bottom: 4px;
}

.login-heading {
    margin-bottom: 16px;
}

.form-control {
    margin-bottom: 24px;
}

.mb-more {
    margin-bottom: 42px;
}

.login-form {
    max-width: 500px;
    margin: auto;
}

.login-input {
    width: 100%;
    font-size: 16px;
    padding: 12px 16px;
    outline: 0;
    border-radius: 3px;
    border: 1px solid lightgrey;
}

.btn-submit {
    width: 100%;
    padding: 14px 12px;
    font-size: 18px;
    font-weight: bold;
    background: #60BD4F;
    color: white;
    border-radius: 3px;
    cursor: pointer;

    &:hover {
        background: darken(#60BD4F, 10%);
    }
    
    &:disabled {
        background: lighten(#60BD4F, 25%);
        cursor: not-allowed;
    }
}
.component-fade-enter-active, .component-fade-leave-active {
  transition: opacity .3s ease;
}
.component-fade-enter, .component-fade-leave-to
/* .component-fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}

.server-error {
    margin-bottom: 12px;
    font-size: 16px;
    padding: 10px 16px;
    color: #a94442;
    background: #f3dede;
    border-radius: 4px;
}

.success-message {
    background-color: #dff0d8;
    color: #3c763d;
    margin-bottom: 12px;
    font-size: 16px;
    padding: 10px 16px;
    border-radius: 4px;
}

// spinner

.lds-ring-container {
    position: absolute;
    right: 50%;
}

.lds-ring {
    display: inline-block;
    position: relative;
    height: 64px;
}

.lds-ring.login {
    width: 64px;
}

.lds-ring.register {
    width: 94px;
}


.lds-ring div {
  box-sizing: border-box;
  display: block;
  position: absolute;
  width: 25px;
  height: 25px;
//   margin: 8px;
  border: 3px solid #fff;
  border-radius: 50%;
  animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
  border-color: #fff transparent transparent transparent;
}
.lds-ring div:nth-child(1) {
  animation-delay: -0.45s;
}
.lds-ring div:nth-child(2) {
  animation-delay: -0.3s;
}
.lds-ring div:nth-child(3) {
  animation-delay: -0.15s;
}
@keyframes lds-ring {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

</style>
