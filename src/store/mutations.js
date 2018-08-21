/*======================================
| Vuex Mutation Catalog
========================================

exampleMutation:
  Params:
    example(string)
    example2(object)
  Description:
    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut

*/

const mutations = {
  updatePost (state, newData) {
    state.post = newData;
  },
  updateArchive (state, newData) {
    state.archive = newData;
  }
}

export default mutations;
