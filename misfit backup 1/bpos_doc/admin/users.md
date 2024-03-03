## Table of Content

---
- [User Index](#user-index)
- [User Create](#user-create)
- [User Show](#user-show)
- [User Delete](#user-delete)
- [User Block](#user-block)
- [User Unblock](#user-unblock)
- [User Blocked List](#user-blocked-list)

### User Index
---
* **URL:** `{{Base_url}}/api/admin/users/index`

* **Method:** `GET`

* **Authorization:** {{token}}

*  **Params:**


* **Success Response:**

    * **Code:** 200 <br />
      **Content:**
```json
[{
    "data": [
        {
            "id": 2,
            "first_name": null,
            "last_name": null,
            "user_name": "user_name1",
            "mobile_number": "01900998878",
            "photo": "avatar.png",
            "email": "email@gmail.com1",
            "email_verified_at": null,
            "slug": null,
            "status": 1,
            "created_at": "2024-01-24T13:39:33.000000Z",
            "updated_at": "2024-01-24T13:39:33.000000Z"
        }
    ]
}]
```

* **Error Response:**

### User Create

---
Returns response for a new User.

* **URL:** `{{Base_url}}/api/admin/users`

* **Method:** `POST`

* **Authorization:** {{token}}

*  **Params:**

`first_name` string optional <br />
`last_name` string optional <br />
`user_name` string **required** <br />
`mobile_number` string **required** <br />
`email` email **required** <br />
`password` string **required** <br />


**Example**:
```json
{
    "user_name":"user_name1",
    "first_name":"User",
    "last_name":"Name",
    "mobile_number":"01900998878",
    "email":"email@gmail.com1",
    "password":"123456789"
}
```


* **Success Response:**

**Code:** 201 <br />
**Content:**
```json
{
    "message": "User created Successfully",
    "data": {
        "first_name": null,
        "last_name": null,
        "user_name": "user_name1",
        "mobile_number": "01900998878",
        "email": "email@gmail.com1",
        "updated_at": "2024-01-24T13:39:33.000000Z",
        "created_at": "2024-01-24T13:39:33.000000Z",
        "id": 2
    }
}
```

* **Error Response:**

### User Show
---
Returns details of a User.

* **URL:** `{{Base_url}}/api/admin/users/show/2`

* **Method:** `GET`

* **Authorization:** {{token}}

*  **Params:** None

**Example**: None

* **Success Response:**

    * **Code:** 200 <br />
      **Content:**
```json
{
    "data": {
        "id": 2,
        "first_name": null,
        "last_name": null,
        "user_name": "user_name1",
        "mobile_number": "01900998878",
        "photo": "avatar.png",
        "email": "email@gmail.com1",
        "email_verified_at": null,
        "slug": null,
        "status": 1,
        "created_at": "2024-01-24T13:39:33.000000Z",
        "updated_at": "2024-01-24T13:39:33.000000Z"
    }
}
```

* **Error Response:**

| Status Code |      Description     |
|:-----------:|:--------------------:|
|     404     |  Division not Found  |

### User Delete 
---

Returns delete response of a User.

* **URL:** `{{Base_url}}/api/admin/users/delete/{id}`

* **Method:** `DELETE`

* **Authorization:** {{token}}

*  **Params:** None

* **Example**: None

* **Success Response:**

    * **Code:** 200 <br />
      **Content:**
```json
{
  "message": "Successfully deleted"
}
```

* **Error Response:**

### User Block
---

Returns Blocking response of a User.

* **URL:** `{{{Base_url}}/api/admin/users/block/{id}`

* **Method:** `PUT`

* **Authorization:** {{token}}

*  **Params:** None

* **Example**: None

* **Success Response:**

    * **Code:** 200 <br />
      **Content:**
```json
{
    "message": "User blocked Successfully"
}
```

* **Error Response:**

### User Unblock
---

Returns Unblocking response of a User.

* **URL:** `{{Base_url}}/api/admin/users/unblock/{id}`

* **Method:** `PUT`

* **Authorization:** {{token}}

*  **Params:** None

* **Example**: None

* **Success Response:**

    * **Code:** 200 <br />
      **Content:**
```json
{
    "message": "User Unblocked Successfully"
}
```

### User Blocked List
---

Returns Blocked User List.

* **URL:** `{{Base_url}}/api/admin/users/blocked`

* **Method:** `GET`

* **Authorization:** {{token}}

*  **Params:** None

* **Example**: None

* **Success Response:**

    * **Code:** 200 <br />
      **Content:**
```json
{
    "data": [
        {
            "id": 1,
            "first_name": null,
            "last_name": null,
            "user_name": "user_name",
            "mobile_number": "01900998877",
            "photo": "avatar.png",
            "email": "email@gmail.com",
            "email_verified_at": null,
            "slug": null,
            "status": 0,
            "created_at": "2024-01-24T13:38:36.000000Z",
            "updated_at": "2024-01-24T13:44:43.000000Z"
        }
    ]
}
```