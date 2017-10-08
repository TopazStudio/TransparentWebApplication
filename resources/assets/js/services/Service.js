import { connect } from 'camo';

export default class Service {

    /**
     * Check if 'camo' ODM is connected.
     *
     * @return bool.
     * */
    isConnected(){
        return !(global.CLIENT === null || global.CLIENT === undefined);
    }

    /**
     * Connect camo ODM with the intended client.
     *
     * @param client default 'nedb://static/db/collections'
     * */
    async connect(client = 'nedb://static/db/collections'){
        console.log('Connecting to database');
        await connect(client);
    }
}
