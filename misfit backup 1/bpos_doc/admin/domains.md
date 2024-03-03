## Table of Content

---
- [Domain Index](#domain-index)
- [Domain Create](#domain-create)
- [Domain Show](#domain-show)
- [Domain Update](#domain-update)
- [Domain Delete](#domain-delete)

### Domain Index
---
* **URL:** `{{Base_url}}/api/admin/domains`

* **Method:** `GET`

* **Authorization:** {{token}}

*  **Params:**
   `relation` string **optional** value: user <br />
   Note: if passes with correct value, it will return with relational data

* **Success Response:**

    * **Code:** 200 <br />
      **Content:**

```json
"data": 
[
    {
        "id": 6,
        "domain": "user_name1",
        "sub-domain": "dev4",
        "user_id": 1,
        "creator": 1,
        "slug": "user-name1",
        "created_at": "2024-01-24T17:35:20.000000Z",
        "updated_at": "2024-01-24T17:43:01.000000Z"
    },
    {
        "id": 5,
        "domain": "user_name1",
        "sub-domain": "dev",
        "user_id": null,
        "creator": 1,
        "slug": "user-name1",
        "created_at": "2024-01-24T17:25:28.000000Z",
        "updated_at": "2024-01-24T17:25:28.000000Z"
    }
]
```

* **Error Response:**

### Domain Create

---
Returns response for a new Domain.

* **URL:** `{{Base_url}}/api/admin/domains`

* **Method:** `POST`

* **Authorization:** {{token}}

*  **Params:**

`domain` string **required** <br />
`sub-domain` string **required** <br />
`user_id` Integer optional <br />


**Example**:
```json
{
    "domain":"user_name1",
    "sub-domain":"dev1",
    "user_id":"1",
}
```


* **Success Response:**

**Code:** 201 <br />
**Content:**
```json
{
    "data": {
        "domain": "user_name1",
        "sub-domain": "dev1",
        "creator": 1,
        "user_id": "1",
        "slug": "user-name1",
        "updated_at": "2024-01-24T17:35:20.000000Z",
        "created_at": "2024-01-24T17:35:20.000000Z",
        "id": 6
    }
}
```

* **Error Response:**

### Domain Show
---
Returns details of a Domain.

* **URL:** `{{Base_url}}/api/admin/domains/{id}`

* **Method:** `GET`

* **Authorization:** {{token}}

*  **Params:** 
   `relation` string **optional** value: user <br />
   Note: if passes with correct value, it will return with relational data

**Example**: None

* **Success Response:**

    * **Code:** 200 <br />
      **Content:**
```json
{
    "data": {
        "id": 6,
        "domain": "user_name1",
        "sub-domain": "dev1",
        "user_id": 1,
        "creator": 1,
        "slug": "user-name1",
        "created_at": "2024-01-24T17:35:20.000000Z",
        "updated_at": "2024-01-24T17:35:20.000000Z",
        "user": {
            "id": 1,
            "first_name": null,
            "last_name": null,
            "user_name": "user_name",
            "mobile_number": "01900998877",
            "photo": "avatar.png",
            "email": "email@gmail.com",
            "email_verified_at": null,
            "slug": null,
            "status": 1,
            "created_at": "2024-01-24T13:38:36.000000Z",
            "updated_at": "2024-01-24T15:40:22.000000Z"
        }
    }
}
```

* **Error Response:**

| Status Code |      Description     |
|:-----------:|:--------------------:|
|     404     |  Domain not Found  |


### Domain Update

---
Returns response for a new Domain.

* **URL:** `{{Base_url}}/api/admin/domains/{id}`

* **Method:** `POST`

* **Authorization:** {{token}}

*  **Params:**

`domain` string **required** <br />
`sub-domain` string **required** <br />
`_method` string **required** Value=PUT <br/>   
`user_id` Integer optional <br />


**Example**:
```json
{
    "domain":"user_name1",
    "sub-domain":"dev1",
    "user_id":"1",
    "_method":"PUT"
}
```


* **Success Response:**

**Code:** 201 <br />
**Content:**
```json
{
    "data": {
        "id": 6,
        "domain": "user_name1",
        "sub-domain": "dev4",
        "user_id": "1",
        "creator": 1,
        "slug": "user-name1",
        "created_at": "2024-01-24T17:35:20.000000Z",
        "updated_at": "2024-01-24T17:43:01.000000Z"
    }
}
```

* **Error Response:**


### Domain Delete 
---

Returns delete response of a Domain.

* **URL:** `{{Base_url}}/api/admin/domains/{id}`

* **Method:** `DELETE`

* **Authorization:** {{token}}

*  **Params:** None

* **Example**: None

* **Success Response:**

    * **Code:** 200 <br />
      **Content:**
```json
{
    "message": "domain deleted successfully"
}
```

* **Error Response:**
