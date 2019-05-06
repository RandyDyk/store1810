<?php
    return [
        //应用ID,您的APPID。
		'app_id' => "2016092500595005",

		//商户私钥
		'merchant_private_key' => "MIIEowIBAAKCAQEA2pbLFKORzqxq8iRbqnus5AVh6Ai9ylnQIWuPfUaiUqkxo5oiwXEgejf53b2ef5VE8WlGDtq3tQpqCv6yp86otDDtUQG1M1OBHcgxrzRp+09pTsNwVmtAcyZg1Fl3lknN/81n0GpxVtsdI/jlkIeJwbOOvGe3UXiWBR9rKwYhVwZ1B43fVbbio8buuso28t3EVgcGXBrGlQDBmsnn2aBaxqvPcuNIy1IOjDdJpo2rE3cJQ4IJsaIsk6yZ5zg3qyga/CacnwegyQg8bnI23XiS/5LF+EtC5MHHM3uO7TSplPgx0nS6Jp3802x9928fq5vk3Jg1ahTH0jLofGG1R5at1QIDAQABAoIBABgEk6Hb6yx7U3Dxv8S2vCN91+kn9LqkLbNOX0DTnwhYIOUqDYGVzYzAU8sih6TbIO0ptRHyxFa3Izm8DKNVmMHb0mehOWi/VyOPmK34o2CCtD58SP6l4DoG0ILkpbg0udbOmgaTe4qgns4SDh9YVTGcaiWXe9QO3OUJM7xRex5Vmk5+UG4Et0z9gQu+fjM/PmJyY7L35GBeULM3awbMcKlkHF2vrQ+S+J3halMX0aumWEq981NsM6hJUR49nTu1pZ/yidUNGEzUNYHbtPnJguBxtGG97ZngcHn1A0xjmRB4i/wGwLLMmTSrtPznywjTzQxumPywkoDQXYjk66c7lO0CgYEA8Fo0E3E1nBdnxr5/kmZJ1CF8pG80hBPqjsEVUR9CnNvAqSOzDxxKhcVnySE67je6m/jvUSRmKFi/OaNezmqX5kKPUXWjQpBaiJn0FxwDMobQ+SrUQbjGLA6nncQ1tJXE4i8vnRSubvtL+NfN5tLIPIveGS5Y7tCtuJou89kgSO8CgYEA6NHf7oHPsFt/HWsMUxOMPKZqzvJIOZt56mo26KEAgwQq5onqoE84KSaVMRUn6FsK0W8ugFU5NIavwJ95BD3La+DeXfuIy4G3ibxYn8GDJZn557LTkPIIrRU0KyEAL2dy3AG8wEyDOy3zBwD1Fo3bO/LizQQvD3SsYxE3LhGYjXsCgYApzDYEL4rYI0XbzSMYTYuHRW+MlP43/dKrkq5nVh1ac+jUQS4RcaUQEF1VH99EsBJWr3rGzKKrX4uZtWx2TxktZOPRkbibickEumk1X5y6u7E5s5YH+98SqFXD3OxOBEGh5/zKv176U99JXhYjjwJdbSFplaLHnSio0r9ZjqfLpwKBgFlkM9G0v9Sb3NujvXCsYbzrvLjGp9qOiqnprDl3j+W+FOa9b3urzwllygS1dcQuKKIvSTB3CGbVi+euk12AiHlcNqTpLiXNIXZd/b0hJMSsMRq4O6k8dP5X1Nb2bcbFtoEonZtMBVsUkmpPAMtvHg0Pfetvvs31YzcKZiBnGya/AoGBAMb1QiANF58Vb+32lTsstt9dZ8kw6fNQZS6USzHjkq0v1nEoqX7AKdWQX5P9GniUpL38OH2k6fPRMV7bA9wi4DlHwu1rurNci6vxtm7FmMDsjZlmud/9a/E4B8eXAm/70ZtzJxjt1k9f1bO4S3ZWhkgUW2clCaTFCEwlcbAXOMwE",
		
		//异步通知地址
		'notify_url' => "http://外网可访问网关地址/alipay.trade.page.pay-PHP-UTF-8/notify_url.php",
		
		//同步跳转
		'return_url' => "http://www.xshop.com/return_url",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "-----BEGIN PUBLIC KEY-----MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEApT7SzF3IfoeurvU9rJY/Y0GbmOpP0ZvvYW5b0B6JXjp/9lBifzv7hdRVOmm0QofUfUSfIpTcpioAsbTGun5jgzB20BlYWUR1tPu3Zkio4WAEorLlRktoRQdTcESkj9MqO9h4Ldsgd04uFtnKjkdY2NIOBWma2uHK3jVnqHHPEcsUMnXDZQyrYcHKWeQYc2QvJYAJlIQHNyskob8sMN6W6PtuJFwfPocXy+XeRFbyqW5G/EuGETr1qpfWFa3AqcrsloCTjH4XW8yErvzpH0Cgu0vpA9Rf7Z/w6BKlx0a09uVSSL3SoEuugQOOrjvynAst4ntA6kD5zNUfUMJqO3tvtQIDAQAB-----END PUBLIC KEY-----",
    ]
?>