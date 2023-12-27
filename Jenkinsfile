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
		sh 'docker stop httptst01 && docker rm httptst01'
		sh 'docker run -dit --name httptst01 -p80:80 httptst'
            }
        }

	stage('IaC')
	{
	steps
	{
	sh 'cd tr && terraform init && terraform plan && terraform apply -auto-approve && terraform destroy -auto-approve'
	}
	}

}
}

