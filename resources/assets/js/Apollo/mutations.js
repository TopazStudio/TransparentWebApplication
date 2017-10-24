import gql from 'graphql-tag';

export const REGISTER_COMPANY = gql`
mutation REGISTER_COMPANY($raw: String) {
  company(raw: $raw,type: "Add") {
    id
    name
    pictures{
        location
    }    
  }
}
`;