export default {
    state: {
        manpowers: [],
        manpower: {}
    },
    getters: {
        getManpowers: state => {
            return state.manpowers;
        },
        getManpower: state => {
            return state.manpower;
        }
    },
    mutations: {
        clearManpowers: state => {
            state.manpowers = [];
        },
        clearManpower: state => {
            state.manpower = {}
        },
        setManpowers: (state, payload) => {
            state.manpowers  = payload.data;
        },
        setManpower: (state, payload) => {
            state.manpower = payload.data;
        }
    },
    actions: {
        clearManpowers: context => {
            context.commit('clearManpowers');
        },
        clearManpower: context => {
            context.commit('clearManpower');
        },
        loadManpowers: (context, payload) => {
            context.commit('setLoadingState', true);
            axios.get(payload)
            .then( response => {
                context.commit('setManpowers', response);
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                }, 1000);
            })
            .catch( error => {
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                }, 1000);
                console.log(error.response);
            });
        },
        loadManpower: (context, payload) => {
            axios.get('api/manpowers/' + payload.id)
            .then(response => {
                context.commit('setManpower', response);
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                }, 1000);
            })
            .catch(error => {
                console.log(error.response);
            })
        },
        storeManpower: (context, payload) => {
            axios.post('api/manpowers', payload)
            .then( response => {
                setTimeout(() => {
                    context.commit('setServerResponse', response);
                    $("#createUserModal").modal('hide');
                    toastr.success('Success', response.data.message);
                    //document.getElementById('manpowerForm').reset(); 
                }, 1000);  
            })
            .catch(error =>{
                context.commit('setServerResponse', error.response);
            });
        },
        updateManpower: (context, payload) => {
            axios.patch('api/manpowers/' + payload.id, payload)
            .then( response => {
                setTimeout(() => {
                    context.commit('setServerResponse', response);
                    $("#createUserModal").modal('hide');
                    toastr.success('Success', response.data.message);
                    //document.getElementById('manpowerForm').reset(); 
                }, 1000);   
            })
            .catch( error => {
                context.commit('setServerResponse', error.response);
            });
        },
        deleteManpower: (context, payload) => {
            axios.delete('api/manpowers/' + payload.manpower.id)
            .then( response => {
                toastr.success('Success', response.data.message);
            })
            .catch( error => {
                context.commit('setServerResponse', error.response.data);
                console.log(error)
            });
        }
    }
}