// // resources/js/store/index.js
// import { createStore } from 'vuex';

// const store = createStore({
//     state: {
//         user: null, // or appropriate state for authentication
//     },
//     mutations: {
//         setUser(state, user) {
//             state.user = user;
//         },
//     },
//     getters: {
//         isAuthenticated: state => !!state.user,
//     },
//     actions: {
//         login({ commit }, user) {
//             // Perform login logic, then set the user
//             commit('setUser', user);
//         },
//         logout({ commit }) {
//             // Perform logout logic, then clear the user
//             commit('setUser', null);
//         },
//     },
// });

// export default store;
