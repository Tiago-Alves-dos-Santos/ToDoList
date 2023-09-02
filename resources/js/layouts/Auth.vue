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
export default {
    data() {
        return {
            animationsClass: {
                containerImage: '',
                containerBody: ''
            }
        }
    },
    methods: {
        loadAnimationToggleDirection(operation) {
            switch (operation) {
                case 0:
                    this.animationsClass.containerImage = 'animation-left-to-right-back';
                    this.animationsClass.containerBody = 'animation-right-to-left-back';
                    break;
                case 1:
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
