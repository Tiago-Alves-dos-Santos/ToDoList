<template>
    <div id="layout-auth">
        <div :class="['container-image', animationsClass.containerImage]"></div>
        <div :class="['container-body', animationsClass.containerBody]">
            <div class="form-login">
                <slot />
            </div>
        </div>

    </div>
</template>
<script>
import TypeOperation from '../enums/TypeOperation';

export default {
    data() {
        return {
            dataTypeOperation: TypeOperation,
            animationsClass: {
                containerImage: '',
                containerBody: ''
            }
        }
    },
    methods: {
        loadAnimationToggleDirection(operation) {
            switch (operation) {
                case TypeOperation.auth.login:
                    this.animationsClass.containerImage = 'animation-left-to-right-back';
                    this.animationsClass.containerBody = 'animation-right-to-left-back';
                    break;
                case TypeOperation.auth.register:
                    this.animationsClass.containerImage = 'animation-left-to-right';
                    this.animationsClass.containerBody = 'animation-right-to-left';
                    break;

                default:
                    break;
            }
        },
    }
}
</script>
