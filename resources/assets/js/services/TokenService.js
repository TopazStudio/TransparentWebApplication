import Token from '../models/Token';
import Service from './Service';

export default class TokenService extends Service{

    /**
     * Decrypt the token received.
     *
     * @param token Token received from backend
     * @return Object decrypted token
     * */
    decrypt(token){
        const base64Url = token.split('.')[1];
        const base64 = base64Url.replace('-','+').replace('_','/');
        return JSON.parse(window.atob(base64));
    }

    /**
     * Return currently stored token.
     *
     * @return String Token received from backend.
     * */
    async getToken(){
        if (!this.isConnected()) await this.connect();
        return Token.findOne({_id:'token'});
    }

    /**
     * Store or Update token received into database
     *
     * @param token Token received from backend
     * @return Promise
     * */
     async setToken(token){
        if (!this.isConnected()) await this.connect();
        return Token.findOneAndUpdate({_id: 'token'},{
            _id: 'token',
            decrypted: this.decrypt(token),
            token: token
        },{upsert: true});
    }

    /**
     * Attempt to login User
     *
     * @param form credentials filled by user on login.
     * */
    async login(form){
        let response = await axios.post('http://laradev.dev/api/user/signin',form);
        await this.setToken(response.data.token);
        return response.data.token;
    }
}