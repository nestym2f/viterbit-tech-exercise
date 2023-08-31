# Startup Guide

## Start containers

Only on first time:

```make init```

Yoy could check another useful make commands checking Makefile, like, build project, install dependencies...

After containers going up execute ```make build```

Then you can do ```make stop``` to stop container or ```make start``` to start it

Visit ```http://localhost``` and check that environment it's working

## Exercise

**Development of an Application Tracking System PoC**

**Description:**

In this exercise, you're going to create an Application Tracking System PoC using Symfony, MongoDB, and Twig.

**Step 1:**

Please clone this repo to your own github (or other) repository or use the "Use template" Github option . 
We recommend you make a **private repository** to keep process confidentiality and other candidates cannot see your solution ;-)

**Step 2:**

Develop.

**Step 3:**

Provide us a zip file with your coded solution

## ATS PoC Requisitions

- Implement a feature that allows candidate's to apply to a job. Each application should include details such as candidate name, contact information, position applied for, application date, and status.
- Create a user interface using Twig that allows candidates to input the necessary details to apply to a job. A job apply page.
- Implement the capability to display a list of job applications on a dedicated page. The applications should be organized chronologically, with the most recent applications appearing first.
- Enable users to filter applications based on different criteria, such as application status or position. The filtering should happen in real-time as users interact with the filters.
- Write comprehensive unit and integration tests for both the job application submission process and the filtering functionality.

## Evaluation Criteria

Our valuation will be based on the following criteria:

1. Accurate implementation of the job application submission functionality.
2. Appropriate utilization of MongoDB and Symfony components.
3. Effective implementation of application filtering and status management.
4. Quality and clarity of the code, including adherence to coding best practices. Solid, Hexagonal...
5. Adequate test coverage, encompassing both unit and integration testing.
6. Problem-solving skills and ability to make informed technical decisions.
