import { Document } from 'camo';

export default class Token extends Document{
    constructor(){
        super();

        //Schema
        this.schema({
            _id: {
                type: String,
                default: 'token'
            },
            decrypted: Object,
            token: String
        });

    }

    static collectionName(){
        return 'Tokens';
    }
}