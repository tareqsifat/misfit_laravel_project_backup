export const card = {
    namespaced: true,
    state:{
        cards: [],
        card_lists: [],
    },
    getters:{
        cardList(state){
            return state.cards;
        },
        checkoutCardList(state){
            return state.card_lists;
        }
    },
    actions:{
        cardList(context, payload){
            axios.get('/admin/card/?page='+payload)
            .then((result) => {
                context.commit('cardList', result.data.cards)
            }).catch((error) => {

            });
        },
        checkoutCardList(context){
            axios.get('/checkout-greetings-card')
            .then((result) => {
                context.commit('checkoutCardList', result.data.card_lists)
            }).catch((error) => {

            });
        }
    },
    mutations:{
        cardList(state, payload){
            return state.cards = payload
        },
        checkoutCardList(state, payload){
            return state.card_lists = payload
        },
    }
}
