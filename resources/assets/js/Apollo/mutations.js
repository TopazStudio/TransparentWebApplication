import gql from 'graphql-tag';

export const REGISTER_COMPANY = gql`
mutation REGISTER_COMPANY($raw: String) {
  company(raw: $raw,type: "Add") {
    id
    name
    businessNo
    description
    latitude
    longitude
    pictures{
        location
    }    
  }
}
`;

export const REVIEW = gql`
mutation REVIEW($raw: String,$type: String) {
  review(raw: $raw,type: $type) {
    id
    content
    company{
      id
    }
  }
}
`;