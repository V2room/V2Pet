# V2Pet Frontend

## api 호출

```shell
requestService.call(
    // get post put delete
    'get', 
    // url
    route('some.path'), 
    // data
    {
        message: 'some message',
    },
    // response callback
    response => {
      // todo someting 
      console.log(response);
    }, 
    // error callback, default = null, 생략 가능
    error => {
      // todo someting 
      console.log(error.message);
    })
);
```

## 비동기 api 호출

```shell
const [formError, setFormError] = useState(null);
const requestService = new RequestService(setFormError);

requestService.callAxios(
    // get post put delete
    'post',
    // url
    route('some.path'), 
    // data
    {
        message: 'some message',
    }, 
    // response callback
    response => {
      // todo someting 
      console.log(response);
    }, 
    // error callback, default = null, 생략 가능
    error => {
      // todo someting 
      console.log(error.message);
    })
);
```
