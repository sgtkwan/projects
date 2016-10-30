% you might want to have as many negative examples as positive examples
n_have = 0;
n_want = numel(dir('cropped_training_images_faces/*.jpg'));

imageDir = 'images_notfaces';
imageList = dir(sprintf('%s/*.jpg',imageDir));
nImages = length(imageList);

new_imageDir = 'cropped_training_images_notfaces';
mkdir(new_imageDir);

dim = 36;

while n_have < n_want
    img1=imread(imageList(nImages).name);
    img1=im2single(rgb2gray(img1));
    for i=0:size(img1,2)
        if n_have < n_want
            length=round(rand(1)*(size(img1,1)-38));
            width=round(rand(1)*(size(img1,2)-38));
            crop=imcrop(img1,[width length 35 35]);
            imwrite(crop,['cropped_training_images_notfaces/', num2str(n_want), '.jpg']);
            disp(n_want);
            n_want=n_want-1;
        end
    end
    
    nImages=nImages-1;
    % generate random 36x36 crops from the non-face images
    
end
