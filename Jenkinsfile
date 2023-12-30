pipeline
{
agent any
stages
{

      stage('Build'){
            steps{
	    sh 'ls -ltr'
	    sh 'pwd'
                echo "I am in build"
                sh 'cd docker && docker build -t httptst .'
                sh 'docker image ls | grep httptst'
	//	sh 'docker stop httptst01 && docker rm httptst01'
	//	sh 'docker run -dit --name httptst01 -p80:80 httptst'
            }
        }


	stage('Tag Image')
	{
	steps{
	       sh 'docker image tag httptst susigugh/httptst:1.0'
            }
        }


	stage('Push Image to Docker Hub')
	{
	steps{
        sh 'docker login -u=${udockersusigugh} -p=${pdockersusigugh} && docker push susigugh/httptst:1.0'
	}
	}


stage('Deploy to Kubernetes')
{
steps
{
sh 'chmod 600 jmtksrv01.pem'
sh 'scp -i jmtksrv01.pem -o StrictHostKeyChecking=no kubernetes/httpdep.yaml ec2-user@3.6.1.16:/home/ec2-user'
}
}


//	stage('IaC')
//	{
//	steps
//	{
//	sh 'cd tr && terraform init && terraform plan && terraform apply -auto-approve && terraform destroy -auto-approve'
//	}
//	}

}
}

