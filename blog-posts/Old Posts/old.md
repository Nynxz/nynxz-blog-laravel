---
date: 2024-12-05T13:01:00Z
title: Simple API Gateway!
tags:
    - Web
    - API
---

I have been working on a project and wanted to figure out a method of monitoring my API endpoints.
I explored solutions like [Kong Gateway](https://konghq.com/products/kong-gateway) and while interesting I found it rather verbose for my needs.
So instead I built a simple prototype gateway using:

- [Express](https://expressjs.com/) - Setup HTTP endpoints
- [PostgreSQL](https://www.postgresql.org/) - Store User Credentials & API Keys
- [Prisma ORM](https://www.prisma.io/orm) - Manage DB Connection and Schemas
- [InfluxDB](https://www.influxdata.com/) - Time Series Analytics


So what do we want to acomplish

- We want a user to be able to register their username and password
- We want to give that user the ability to request an API key
- We want to allow other endpoint access only if a valid API key is supplied
- We want to log who is using those endpoints and when

If you want to contact me for questions or comments feel free!

### Project Setup
I am using pnpm but you can use any package manager
```sh
mkdir simple_api_gateway
cd simple_api_gatway
pnpm init
pnpm install dotenv express @prisma/client @influxdata/influxdb-client
pnpm install -D @types/express @types/node nodemon ts-node typescript prisma
pnpm exec tsc --init
```

For testing I will just run my index.ts through nodemon
```json
// package.json
  ...
  "scripts": {
    "dev": "pnpm exec nodemon src/index.ts"
  },
  ...
```

### Express Setup
Lets see if things are setup...
```sh
touch src/index.ts
touch .env
```

```bash
# .env
PORT=3019
```

```ts
// src/index.ts
import express, { Express, Request, Response } from "express";
import * as dotenv from "dotenv";

dotenv.config();

const app: Express = express();
const port = process.env.PORT || 3000;

app.get("/", (req: Request, res: Response) => {
  res.send("Simple API Gateway!");
});

app.listen(port, () => {
  console.log(`[server]: Server is running at http://localhost:${port}`);
});
```

```bash
pnpm dev
>> [server]: Server is running at http://localhost:3019
``` 
If we send a request with something like [Insomnia](https://insomnia.rest/) or [Postman](https://www.postman.com/), we should get back a response!

![Insomnia](https://utfs.io/f/60e5b943-3101-43bb-9111-405a89f108b6-ugkhid.png)


### PostgreSQL Setup

I have PostgreSQL installed locally on my machine for testing but
[Prisma - Setting up a local PostgreSQL database](https://www.prisma.io/dataguide/postgresql/setting-up-a-local-postgresql-database) has a good guide if you need.

this will create a /prisma/schema.prisma file
and add a DATABASE_URL to our .env
```bash
pnpm exec prisma --init
```

edit the .env file filling in your PostgreSQL information
```bash
# .env
...
DATABASE_URL="postgresql://<USERNAME>:<PASSWORD>@localhost:5432/simple_api_gateway?schema=public"
```

Inside of the prisma/schema.prisma file we need to create our database tables

```js
generator client {
  provider = "prisma-client-js"
}

datasource db {
  provider = "postgresql"
  url      = env("DATABASE_URL")
}

model User {
  id           Int      @id @default(autoincrement())
  username     String   @unique
  password     String
  createdAt    DateTime @default(now())
  apiKeys      ApiKey[]
}

model ApiKey {
  id     Int    @id @default(autoincrement())
  key    String @unique
  User   User   @relation(fields: [userId], references: [id])
  userId Int
}
```
Then we need to 'push' the schema to the database, in production you would migrate, but for testing `db push` is fine.
```bash
pnpm exec prisma db push
>>  Environment variables loaded from .env
    Prisma schema loaded from prisma\schema.prisma
    Datasource "db": PostgreSQL database "simple_api_gateway", schema "public" at 
    "localhost:5432"

    PostgreSQL database simple_api_gateway created at localhost:5432

    Your database is now in sync with your Prisma schema. Done in 115ms

    ✔ Generated Prisma Client (v5.16.0) to .\node_modules\.pnpm\@prisma+client@5.16.0_prisma@5.16.0\node_modules\@prisma\client in 42ms
```

Then we can view our database by using something like [Prisma Studio](https://www.prisma.io/studio) or [pgAdmin](https://www.pgadmin.org/)

Prisma studio is included so we will just use that.
```bash
pnpm exec prisma studio
```
If you open to a page and see your two tables from the schema, Postgres and Prisma are working!

![Prisma Studio Image](https://utfs.io/f/c082e80b-f7b1-44b5-a963-90827ee9b1ab-6mvev5.png)

### Endpoints

I am going to show 3 simple endpoints
- **/register** - takes a username and password, creates a user
- **/request** - takes a username and password, returns an API key if user info is valid
- **/hello** - takes an API key and returns a personalized response to the user - in reality a gateway would route a request like this to another endpoint and route the response to the user, I am not doing that here, this is just a simple 1 server example

best practices are not used here to keep to topic eg: passwords are in plaintext

#### Register
```ts
// src/index.ts
import { PrismaClient } from "@prisma/client";
const prisma = new PrismaClient();
...
app.use(express.json()); //we want to parse json bodies


app.post("/register", async (req: Request, res: Response) => {
  const username = req.body.username?.toString();
  // TODO: password hasher
  const password = req.body.password?.toString();
  console.log(`Got ${username} ${password}`);
  console.log("Finding if username is taken");
  const alreadyFoundUsers = await prisma.user.findFirst({
    where: { username: username },
  });

  console.log(`Trying to register user ${username}`);
  if (!alreadyFoundUsers && username && password) {
    console.log("Username available, registering...");

    await prisma.user.create({
      data: {
        username,
        password,
      },
    });

    console.log(`Created user ${username}: ${password}`);
    res.send(`Registered user: ${username}: ${password}`);
    return;
  }
  res.send(`Failed creating: ${username}`);
  return;
});
```
Now with this POST endpoint, if we send a request with Insomnia, with a JSON body that contains a "username" and "password", it will create a user in our database. I've used Insomnia to autogenerate a username and password

eg
```json
{
  "username": "testuser",
  "password": "testpassword"
}
```

![Insomnia Post Request](https://utfs.io/f/fd26661e-6d53-4c97-8b75-5d0e524bd07f-kv6d65.png)
![Prisma Studio Users](https://utfs.io/f/a0071675-5b67-4e65-b276-5449abb0f27f-7ead2n.png)

If you can see this returned as a response and the user in Prisma Studio or pgAdmin good job!

Thats our "Register" end point complete, now for our 'Request' endpoint, so the user can get an API key


#### Request

```ts
app.get("/request", async (req: Request, res: Response) => {
  const username = req.body.username?.toString();
  const password = req.body.password?.toString();
  console.log(`Trying to request API Key for user ${username}`);
  if (!username) {
    console.log("Failed");
    return res.send(`Failed to Request Key For: ${username}`);
  }

  const validUser = await prisma.user.findFirst({
    where: { username },
  });

  if (!validUser) {
    console.log(`No user: ${username}`);
    res.send("User not found");
  }

  if (validUser?.password == password) {
    console.log("Valid password, generating API Key");
    // https://stackoverflow.com/questions/1497481/javascript-password-generator
    const apiKey = Math.random().toString(36).slice(2, 10).toString();
    await prisma.apiKey.create({
      data: {
        key: apiKey,
        User: { connect: { username } },
      },
    });
    console.log(`Created API Key: ${apiKey}`);
    res.send(`Created API Key for ${username}: ${apiKey}`);
    return;
  }
  res.send(`Failed to create API Key for ${username}`);
});
```

Now we can send a GET request to /request, with a body containing the username and password, which was registered before.
This returns an API Key for the user.

We can also see in Prisma Studio that the User has a linked API Key

![Insomnia Get Request](https://utfs.io/f/312d27fe-b3c0-4f22-93d3-feb5c623ed5a-kv6d66.png)
![Prisma Studio Linked API Key](https://utfs.io/f/452ef6c7-c23a-4e9b-bde7-2fa4883ae426-7ead2m.png)

#### Hello

Now we want to use that API Key to authorize access to an endpoint, in this case /hello

```ts
app.get("/hello", async (req: Request, res: Response) => {
  const apiKey = req.query.apiKey?.toString();
  console.log(`Trying to use apikey: ${apiKey}`);
  if (!apiKey) {
    console.log("Failed");
    return res.send(`Failed to use: ${apiKey}`);
  }
  const validKey = await prisma.apiKey.findFirst({
    where: { key: apiKey },
  });
  if (!validKey) {
    console.log(`No key found: ${validKey}`);
    res.send("API Key not found");
  } else {
    const user = await prisma.user.findFirst({
      where: { id: validKey.userId },
    });
    res.send(`Hello ${user?.username}!`);
  }
});
```

If we send a GET request to /hello, this time with URL parameters containing an "apiKey", instead of a body we should get back a personalized response!

![Insomnia GET /hello](https://utfs.io/f/7cf29a4f-3363-4250-9815-b496039ba1f0-kv6d67.png)

You've created a user, allowed that user to create an API Key, and allowed access to an API with that key, awesome. Now we want to keep track of who is using /hello and when, for this I've chosen to use InfluxDB


### InfluxDB

You will need to install and start InfluxDB - [Install InfluxDB](https://docs.influxdata.com/influxdb/v2/install/) they have a good guide, I've NOT installed 'influx CLI', and have just simply run InfluxDB and accessed it on http://127.0.0.1:8086/

go through the setup UI to create a user, an org and a bucket for your data..
Ive called my org "testorg" and my bucket "testbucket"

you should be given an INFLUXDB_TOKEN, put this into your .env
```bash
# .env
...
INFLUXDB_TOKEN=<token>
```

We need to connect our Express Gateway to InfluxDB

Add this near the top of your /src/index.ts file under `dotenv.config();`, matching your org and bucket to whatever you created above.
```ts
// src/index.ts
...
const { InfluxDB, Point } = require("@influxdata/influxdb-client");
const iDBtoken = process.env.INFLUXDB_TOKEN;
const iDBurl = "http://127.0.0.1:8086";

const iDBclient = new InfluxDB({ url: iDBurl, token: iDBtoken });
let org = `testorg`;
let bucket = `testbucket`;
let writeClient = iDBclient.getWriteApi(org, bucket, "ns");
...
```

Now we want to 'push' data points to our InfluxDB, for this example we want to capture the usage of the /hello endpoint, with a tag of user ID

in src/index.ts we need to create a new 'data point' in our /hello endpoint

we want to keep track of which userId and endpoint is being used, so we will tag them
```ts
// src/index.ts
...
    let point = new Point("endpoint_usage_test")
      .tag("user_id", user?.id)
      .tag("endpoint", "/hello")
      .intField("success", 1)
      .timestamp(new Date());
    writeClient.writePoint(point);
```

This is the new /hello endpoint
```ts
app.get("/hello", async (req: Request, res: Response) => {
  const apiKey = req.query.apiKey?.toString();
  console.log(`Trying to use apikey: ${apiKey}`);
  if (!apiKey) {
    console.log("Failed");
    return res.send(`Failed to use: ${apiKey}`);
  }
  const validKey = await prisma.apiKey.findFirst({
    where: { key: apiKey },
  });
  if (!validKey) {
    console.log(`No key found: ${validKey}`);
    res.send("API Key not found");
  } else {
    const user = await prisma.user.findFirst({
      where: { id: validKey.userId },
    });

    let point = new Point("endpoint_usage_test")
      .tag("user_id", user?.id)
      .tag("endpoint", "/hello")
      .intField("success", 1)
      .timestamp(new Date());
    writeClient.writePoint(point);
    writeClient.flush();
    res.send(`Hello ${user?.username}!`);
  }
});
```

Now with this Point being created and pushed to our InfluxDB, if we send a request to our /hello, we can track the usage.

![InfluxDB Live Chart](https://utfs.io/f/a16bdac9-8883-4052-9f02-f91d78caf995-jabg2t.gif)

We can also create a few users to see who is using the API

![InfluxDB Live Chart Multi](https://utfs.io/f/f66be077-b59d-430e-9f3b-6387ddcbd4bb-jabg2u.gif)


This can be greatly extended and is just a prototype/example on how to use these technologies together.

Thanks for reading my post!


Final Code
```ts
//src/index.ts

import express, { Express, Request, Response } from "express";
import * as dotenv from "dotenv";
import { PrismaClient } from "@prisma/client";
dotenv.config();

const { InfluxDB, Point } = require("@influxdata/influxdb-client");
const iDBtoken = process.env.INFLUXDB_TOKEN;
const iDBurl = "http://127.0.0.1:8086";

const iDBclient = new InfluxDB({ url: iDBurl, token: iDBtoken });
let org = `testorg`;
let bucket = `testbucket`;
let writeClient = iDBclient.getWriteApi(org, bucket, "ns");

const prisma = new PrismaClient();
const app: Express = express();
const port = process.env.PORT || 3000;


app.use(express.json());
app.get("/", (req: Request, res: Response) => {
  res.send("Simple API Gateway!");
});

app.post("/register", async (req: Request, res: Response) => {
  const username = req.body.username?.toString();
  // TODO: password hasher
  const password = req.body.password?.toString();
  console.log(`Got ${username} ${password}`);
  console.log("Finding if username is taken");
  const alreadyFoundUsers = await prisma.user.findFirst({
    where: { username: username },
  });

  console.log(`Trying to register user ${username}`);
  if (!alreadyFoundUsers && username && password) {
    console.log("Username available, registering...");

    await prisma.user.create({
      data: {
        username,
        password,
      },
    });

    console.log(`Created user ${username}: ${password}`);
    res.send(`Registered user: ${username}: ${password}`);
    return;
  }
  res.send(`Failed creating: ${username}`);
  return;
});

app.get("/request", async (req: Request, res: Response) => {
  const username = req.body.username?.toString();
  const password = req.body.password?.toString();
  console.log(`Trying to request API Key for user ${username}`);
  if (!username) {
    console.log("Failed");
    return res.send(`Failed to Request Key For: ${username}`);
  }

  const validUser = await prisma.user.findFirst({
    where: { username },
  });

  if (!validUser) {
    console.log(`No user: ${username}`);
    res.send("User not found");
  }

  if (validUser?.password == password) {
    console.log("Valid password, generating API Key");
    // https://stackoverflow.com/questions/1497481/javascript-password-generator
    const apiKey = Math.random().toString(36).slice(2, 10).toString();
    await prisma.apiKey.create({
      data: {
        key: apiKey,
        User: { connect: { username } },
      },
    });
    console.log(`Created API Key: ${apiKey}`);
    res.send(`Created API Key for ${username}: ${apiKey}`);
    return;
  }
  res.send(`Failed to create API Key for ${username}`);
});

app.get("/hello", async (req: Request, res: Response) => {
  const apiKey = req.query.apiKey?.toString();
  console.log(`Trying to use apikey: ${apiKey}`);
  if (!apiKey) {
    console.log("Failed");
    return res.send(`Failed to use: ${apiKey}`);
  }
  const validKey = await prisma.apiKey.findFirst({
    where: { key: apiKey },
  });
  if (!validKey) {
    console.log(`No key found: ${validKey}`);
    res.send("API Key not found");
  } else {
    const user = await prisma.user.findFirst({
      where: { id: validKey.userId },
    });

    let point = new Point("endpoint_usage_test")
      .tag("user_id", user?.id)
      .tag("endpoint", "/hello")
      .intField("success", 1)
      .timestamp(new Date());
    writeClient.writePoint(point);
    writeClient.flush();
    res.send(`Hello ${user?.username}!`);
  }
});

app.listen(port, () => {
  console.log(`[server]: Server is running at http://localhost:${port}`);
});
```
