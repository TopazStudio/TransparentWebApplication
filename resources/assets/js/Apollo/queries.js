import gql from 'graphql-tag';

//################## USER/VIEWER #####################//
export const GET_USER_QUERY = gql`
query GET_USER_QUERY($id: Int) {
  user(id: $id) {
    id
    name
    role
    email
    pictures{
      location
    }
  }
}`
;

export const GET_USER_REVIEWS = gql`
query GET_USER_REVIEWS {
  viewer {
    review{
      id
      content
      company{
        id 
      }
    }
  }
}`
;

export const LOGIN_VIEWER_QUERY = gql`
query LOGIN_VIEWER_QUERY($email: String,$password: String) {
  login(email: $email,password: $password) {
    token
    user{
      id
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
//######################################################//


//###################  SEARCH  #########################//
/**
 * Return predefined set of attributes of the type, being searched,
 * that are needed in the result list.
 *
 * @return {string}
 * */
export function RESULTS_WANTED_OF(type) {
    switch (type){
        case 'company':
            return `
                    id
                    name
                    description
                    pictures{
                        location
                    }
                `;
            break;
        case 'document':
            return `
                    id
                    name
                    location
                    description
                `;
            break;
        case 'topic':
            return `
                    id
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
//######################################################//

//###################  COMPANY  ########################//
export const GET_COMPANY = gql(`
query GET_COMPANY($id: Int) {
    company(id: $id) {
        id
        name
        businessNo
        description
        latitude
        longitude
        pictures{
            location
        }    
        reviews{
            content
            user{
                id
                name
            }
        }    
    }
}
`);

export const GET_COMPANY_REVIEWS = gql(`
query GET_COMPANY($id: Int) {
  company(id: $id) {
    id
    reviews{
        content
        user{
            id
            name
        }
    }    
  }
}
`);

export const GET_COMPANY_DOCUMENTS = gql(`
query GET_COMPANY_DOCUMENTS($id: Int){
  company(id: $id){
    id
    documents{
      id
      name
      location
      description
      type
      size
    }
  }
}
`);
//######################################################//

//###################     BLOGS   ######################//

export const GET_COMPANY_RELATED_BLOGS = gql(`
query GET_COMPANY_RELATED_BLOGS($id: Int){
  company(id: $id){
    id
    relatedBlogs{
      id
      heading
      content
      url
    }
  }
}
`);
//######################################################//

//#######################  TOPICS   ####################//
export const GET_COMPANY_RELATED_TOPICS = gql(`
query GET_COMPANY_RELATED_TOPICS($id: Int){
  company(id: $id){
    id
    relatedTopics{
      id
      name
    }
  }
}
`);
//######################################################//
