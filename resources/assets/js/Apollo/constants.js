import gql from 'graphql-tag';


export const GET_VIEWER_QUERY = gql`
query GET_VIEWER_QUERY {
  viewerQuery(id: 1) {
    id
    name
    role
    email
  }
}`
;

export const GET_USER_QUERY = gql`
query GET_USER_QUERY($id: Int) {
  viewerQuery(id: $id) {
    name
    role
    email
    pictures{
      location
    }
  }
}`
;

export const LOGIN_VIEWER_QUERY = gql`
query LOGIN_VIEWER_QUERY($email: String,$password: String) {
  viewerLogin(email: $email,password: $password) {
    token
    user{
      name
      email
      role
      pictures{
        location
      }
    }
  }
}
`;

/**
 * Return predefined set of attributes of the type, being searched,
 * that are needed in the result list.
 *
 * @return {string}
 * */
export function RESULT_LIST_OF(type) {
    switch (type){
        case 'company':
            return `
                    name
                    description
                    pictures{
                        location
                    }
                `;
            break;
        case 'document':
            return `
                    name
                    location
                    description
                `;
            break;
        case 'topic':
            return `
                    name
                    description
                    tags{
                        name
                    }
                `;
            break;
        default:
            break;

    }

}

