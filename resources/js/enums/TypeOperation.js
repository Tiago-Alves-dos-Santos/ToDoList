const TypeOperation = Object.freeze({
    crud:{
        create:0,
        read:1,
        update:2,
        delete:3,
        forceDelete:4,
        restore:5
    },
    auth:{
        register: 6,
        login:7,
        passwor_reset:8
    }
});
export default TypeOperation;
