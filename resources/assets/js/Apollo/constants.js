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
query GET_USER_QUERY {
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