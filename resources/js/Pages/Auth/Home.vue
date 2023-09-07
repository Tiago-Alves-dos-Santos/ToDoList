<template>
    <div>
        <div>
            <h1 v-if="$page.props.verified_email">Email verficado</h1>
            <h1 v-else>Verfique o email</h1>
        </div>
    </div>
</template>
