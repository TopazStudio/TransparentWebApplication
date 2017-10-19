import Vue from 'vue';
import VueApollo from 'vue-apollo';
import { ApolloClient,createNetworkInterface } from 'apollo-client';

export const networkInterface = createNetworkInterface({
    uri: 'http://laravel.dev/graphql'
});

export const apolloClient = new ApolloClient({
    networkInterface,
    connectToDevTools: true
});

Vue.use(VueApollo);

export const apolloProvider = new VueApollo({
    defaultClient: apolloClient,
    defaultOptions: {
        $loadingKey: 'loading'
    }
});
